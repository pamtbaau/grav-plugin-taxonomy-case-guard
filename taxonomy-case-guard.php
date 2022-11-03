<?php

namespace Grav\Plugin;

use Composer\Autoload\ClassLoader;
use Exception;
use Grav\Common\Config\Config;
use Grav\Common\Page\Page;
use Grav\Common\Plugin;
use Grav\Common\Taxonomy;
use RocketTheme\Toolbox\Event\Event;


/**
 * Class TaxonomyCaseGuardPlugin
 * @package Grav\Plugin
 */
class TaxonomyCaseGuardPlugin extends Plugin
{

    /**
     * @return array
     *
     * The getSubscribedEvents() gives the core a list of events
     *     that the plugin wants to listen to. The key of each
     *     array section is the event that the plugin listens to
     *     and the value (in the form of an array) contains the
     *     callable (or function) as well as the priority. The
     *     higher the number the higher the priority.
     * 
     * @return  array<string, array<int, int|string>>
     */
    public static function getSubscribedEvents(): array
    {
        return [
            'onPluginsInitialized' => ['onPluginsInitialized', 0],
        ];
    }

    /**
     * Composer autoload
     *
     * @return ClassLoader
     */
    public function autoload(): ClassLoader
    {
        return require __DIR__ . '/vendor/autoload.php';
    }

    /**
     * Initialize the plugin
     */
    public function onPluginsInitialized(): void
    {
        if ($this->isAdmin()) {
            $this->enable([
                'onAdminSave'  => ['onAdminSave', 0],
            ]);

            return;
        }
    }

    public function onAdminSave(Event $event): void
    {
        /** @var Page */
        $page = $event['object'];

        if (!is_a($page, 'Grav\Common\Flex\Types\Pages\PageObject')) {
            return;
        }

        /** @var string */
        $case = $this->config->get('plugins.taxonomy-case-guard.case', 'capitalize');

        $header = $page->header();
        $taxonomy = $header->taxonomy;

        if (isset($taxonomy)) {
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

            $header->taxonomy = $taxonomy;
            $page->header($header);
        }
    }

    public function replaceCase(string $case, string $value): string {
        switch($case) {
            case 'capitalize':
                return ucfirst(strtoLower($value));
            case 'uppercase':
                return strtoupper($value);
            case 'lowercase':
                return strtolower($value);
            default:
                throw new Exception("Case '$case' does not exist");
        }
    }


}
