<?php

namespace Grav\Plugin\Console;

use Exception;
use Grav\Common\Grav;
use Grav\Common\Page\Pages;
use Grav\Console\ConsoleCommand;
use Symfony\Component\Console\Input\InputOption;


/**
 * Class SetCaseAllTaxonomiesCommand
 *
 * @package Grav\Plugin\Console
 */
class SetCaseAllTaxonomiesCommand extends ConsoleCommand
{
    protected function configure(): void
    {
        $this
            ->setName("set-case")
            ->setDescription("Set preferred case to all taxonomy values.")
            ->addOption(
                'case',
                null,
                InputOption::VALUE_REQUIRED,
                'The case: capitalize|uppercase|lowercase'
            )
            ->setHelp('The <info>encrypt-file</info> command replaces "needle" with "replacement".');
    }

    /**
     * @return int|null|void
     */
    protected function serve()
    {
        /** @var string */
        $case = $this->input->getOption('case');

        $this->initializePages();

        /** @var Pages */
        $pages = Grav::instance()['pages'];

        foreach($pages->all() as $page) {
            if (!isset($page->header()->taxonomy)) {
                continue;
            }

            $taxonomy = $page->header()->taxonomy;

            foreach($taxonomy as $taxon => $value) {
                if (is_array($value)) {
                    for ($i = 0; $i < count($value); $i++) {
                        $taxonomy[$taxon][$i] = $this->replaceCase($case, $value[$i]);
                    }

                    $taxonomy[$taxon] = array_unique($taxonomy[$taxon]);
                } else {
                    $taxonomy[$taxon] = $this->replaceCase($case, $value);
                }
            }

            $page->header()->taxonomy = $taxonomy;
            $page->save();
        }

        $this->output->writeln("All taxonomy values have been converted to '$case'");
    }

    public function replaceCase(string $case, string $value): string {
        switch($case) {
            case 'capitalize':
                return ucfirst(strtolower($value));
            case 'uppercase':
                return strtoupper($value);
            case 'lowercase':
                return strtolower($value);
            default:
                throw new Exception("Case '$case' is unknown. Choose one of capitalize|uppercase|lowercase");
        }
    }
}
