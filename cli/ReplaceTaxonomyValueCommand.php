<?php

namespace Grav\Plugin\Console;

use Grav\Common\Grav;
use Grav\Common\Page\Collection;
use Grav\Common\Taxonomy;
use Grav\Console\ConsoleCommand;
use Symfony\Component\Console\Input\InputOption;

/**
 * Class ReplaceTaxonomyValueCommand
 *
 * @package Grav\Plugin\Console
 */
class ReplaceTaxonomyValueCommand extends ConsoleCommand
{
    protected function configure(): void
    {
        $this
            ->setName("replace")
            ->setDescription("Replace value of single taxonomy.")
            ->addOption(
                'search',
                null,
                InputOption::VALUE_REQUIRED,
                "The taxonomy value to be replaced, eg. 'taxonomy.blog'"
            )
            ->addOption(
                'replace',
                null,
                InputOption::VALUE_REQUIRED,
                "The value to replace taxonomy value with e.g. 'Blog'"
            )
            ->setHelp('The <info>replace</info> command replaces the last part of "search" with "replace".');
    }

    /**
     * @return int|null|void
     */
    protected function serve()
    {
        /** @var string */
        $needle = $this->input->getOption('search');

        /** array[string, string] */
        [$taxon, $value] = explode('.', $needle);

        /** @var string */
        $replacement = $this->input->getOption('replace');

        $this->initializePages();

        /** @var Taxonomy */
        $taxonomy = Grav::instance()['taxonomy'];

        /** @var Collection */
        $collection = $taxonomy->findTaxonomy([$taxon => $value]);

        foreach ($collection as $page) {
            $taxonValue = $page->header()->taxonomy[$taxon];

            if (is_array($taxonValue)) {
                for ($i = 0; $i < count($taxonValue); $i++) {
                    if ($taxonValue[$i] === $value) {
                        $taxonValue[$i] = $replacement;
                    }
                }

                $taxonValue = array_unique($taxonValue);
            } else {
                $page->header()->taxonomy[$taxonValue] = $replacement;
            }

            $page->header()->taxonomy[$taxon] = $taxonValue;
            $page->save();
        }

        $this->output->writeln("'$taxon.$value' has been replaced with '$taxon.$replacement'");
    }
}
