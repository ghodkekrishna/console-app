<?php
namespace Console\App\tests\Commands;

use Console\App\Model\SalaryModel;
use PHPUnit\Framework\TestCase;

class ExportCSVCommandTest extends TestCase
{
    public function testDownloadCSVFile()
    {
        $salaryModel = new SalaryModel();
        $output = $salaryModel->downloadCSVFile();

        $this->assertTrue($output);
    }
}