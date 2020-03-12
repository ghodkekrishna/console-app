<?php
/**
 * Created by PhpStorm.
 * User: INV15092015
 * Date: 3/13/20
 * Time: 1:59 AM
 */

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