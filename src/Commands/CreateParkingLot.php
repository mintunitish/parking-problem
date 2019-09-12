<?php
/**
 * Initial Version of CreateParkingLot.php Created By:
 *
 * User: nitishkumar | <mintu.nitish@gmail.com>
 * Date: 12/09/19
 * Time: 8:35 AM
 */

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CreateParkingLot extends Command
{
    protected static $defaultName = 'create_parking_lot';

    protected function configure()
    {
        $this->setDescription('Creates a parking lot.')
             ->setHelp('This command created a parking lot with the defined number of slots.')
             ->addArgument('capacity', InputArgument::REQUIRED, 'Number of Parking Slots');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $capacity = $input->getArgument('capacity');
        $ParkingLot = ParkingLot::instance($capacity);
        if ($ParkingLot->isParkingLotCreated()) {
            $output->writeln("Created a parking lot with $capacity slots");
        }
        else {
            exit(1);
        }
    }
}
