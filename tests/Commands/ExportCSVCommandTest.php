<?php
namespace Console\App\tests\Commands;

use Console\App\Model\SalaryDetails;
use PHPUnit\Framework\TestCase;

class ExportCSVCommandTest extends TestCase
{
    public function testDownloadCSVFile()
    {
        $salaryDetails = new SalaryDetails();
        $output = $salaryDetails->downloadCSVFile();

        $this->assertTrue($output);
    }
}