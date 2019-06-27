<?php

/**
 * This file is part of AlgoliaSearch Client PHP Helper.
 *
 * (c) Algolia Team <contact@algolia.com>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace Algolia\AlgoliaSearch\Helper\Settings\SettingsAttribute;

use Algolia\AlgoliaSearch\Helper\Contracts\SettingContract;
use Algolia\AlgoliaSearch\Helper\Helpers\Str;

/**
 * @internal
 */
final class SearchableAttribute implements SettingContract
{
    /**
     * @var array<int, string>
     */
    private static $unsearchableAttributesKeys = [
        'id',
        '*_id',
        'id_*',
        '*ed_at',
        '*_count',
        'count_*',
        'number_*',
        '*_number',
        '*image*',
        '*url*',
        '*link*',
        '*password*',
        '*token*',
        '*hash*',
    ];
    /**
     * @var array<int, string>
     */
    private static $unsearchableAttributesValues = [
        'http://*',
        'https://*',
    ];

    /**
     * {@inheritdoc}
     */
    public function getDetectedSettings($key, $value, $detectedSettings)
    {
        if (!is_object($value) && !is_array($value) && !Str::is(self::$unsearchableAttributesKeys, $key) && !Str::is(self::$unsearchableAttributesValues, $value)) {
            $detectedSettings[] = $key;
        }

        return $detectedSettings;
    }
}
