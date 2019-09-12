<?php
/**
 * Initial Version of Park.php Created By:
 *
 * User: nitishkumar | <nitish.kumar@sugaldamani.com>
 * Date: 12/09/19
 * Time: 9:06 AM
 */

namespace Console\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class Park extends Command
{
    protected static $defaultName = 'park';

    protected function configure()
    {
        $this->setDescription('Park a vehicle')
             ->setHelp('This command parks a vehicle in the available slot.')
             ->addArgument('registration', InputArgument::REQUIRED, 'Registration number fo the vehicle.')
             ->addArgument('color', InputArgument::REQUIRED, 'Color of the vehicle.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
    }
}
