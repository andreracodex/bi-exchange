<?php

namespace App\Console\Commands;

use App\Models\Currency;
use DOMDocument;
use DOMElement;
use DOMXPath;
use Illuminate\Console\Command;
use Exception;

class FetchExchange extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ambil:rate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get Kurs Exchange Rate from BI';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        try {
            $this->getExchangeRate();
        } catch (Exception $e) {
            $this->error('An error occurred: ' . $e->getMessage());
        }
    }

    private function getExchangeRate()
    {
        // URL of the page to scrape
        $url = 'https://www.bi.go.id/en/statistik/informasi-kurs/transaksi-bi/Default.aspx';

        // Fetch the content of the page
        $html = @file_get_contents($url); // Suppress warnings

        if ($html === false) {
            $this->error('Could not fetch the webpage.');
            return;
        }

        // Create a new DOMDocument instance
        $dom = new DOMDocument();

        // Suppress errors due to malformed HTML
        libxml_use_internal_errors(true);
        
        if (!$dom->loadHTML($html)) {
            $this->error('Failed to parse HTML.');
            return;
        }
        
        libxml_clear_errors();

        // Create a new DOMXPath instance
        $xpath = new DOMXPath($dom);

        // Define the XPath query for the table
        $query = '//table[contains(@class, "table table-striped")]';

        // Execute the query
        $tables = $xpath->query($query);

        if ($tables->length > 0) {
            foreach ($tables as $table) {
                if ($table instanceof DOMElement) {
                    // Get rows from the table
                    $rows = $table->getElementsByTagName('tr');

                    foreach ($rows as $row) {
                        if ($row instanceof DOMElement) {
                            // Get columns from the row
                            $cols = $row->getElementsByTagName('td');

                            // Store the data in an array
                            $rowData = [];
                            foreach ($cols as $col) {
                                $rowData[] = trim(html_entity_decode($col->textContent)); // Decode HTML entities
                            }

                            // Check if the currency code is in the list we want to process
                            $currencyCodes = ['AUD', 'BND', 'CAD', 'CHF', 'CNY', 'CNH', 'DKK', 'EUR', 'GBP', 'HKD', 'JPY', 'KRW', 'KWD', 'LAK', 'MYR', 'NOK', 'NZD', 'PGK', 'PHP', 'SAR', 'SEK', 'SGD', 'THB', 'USD', 'VND'];

                            if (count($rowData) >= 4 && in_array($rowData[0], $currencyCodes)) {
                                $this->updateCurrencyRates($rowData);
                            }
                        }
                    }
                }
            }
        } else {
            $this->info("No tables found.");
        }
    }

    private function updateCurrencyRates(array $rowData)
    {
        try {
            // Convert and clean rates
            $sellRate = (float) str_replace(',', '', $rowData[2]);
            $buyRate = (float) str_replace(',', '', $rowData[3]);

            // Update the database
            Currency::where('code', '=', $rowData[0])->update(['sell_rate' => $sellRate, 'buy_rate' => $buyRate]);

            // Output information
            $this->info("==============================");
            $this->info("Exchange Currency: {$rowData[0]}");
            $this->info("Sell Rate: {$sellRate}");
            $this->info("Buy Rate: {$buyRate}");
            $this->info("==============================");
        } catch (Exception $e) {
            $this->error("Failed to update rates for {$rowData[0]}: " . $e->getMessage());
        }
    }
}