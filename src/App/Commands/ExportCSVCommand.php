<?php
namespace Console\App\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Console\App\Model\SalaryDetails;

class ExportCSVCommand extends Command
{
    protected $salaryDetails;
    public function __construct(SalaryDetails $salaryDetails)
    {
        $this->salaryDetails = $salaryDetails;
        parent::__construct();
    }

    protected function configure()
    {
        $this->setName('export:salary-dates')
            ->setDescription('This is command line tool helps to export CSV file with month-wise salary and bonus dates');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        try {
            $this->salaryDetails->downloadCSVFile();

            // show success message in console
            $output->writeln("CSV file created successfully!");
        } catch(\Exception $e) {
            // show error message in console
            $output->writeln("Error : ".$e->getMessage());
        }
    }
}