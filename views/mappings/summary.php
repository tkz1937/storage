<?php

/**
 * Mappings summary view.
 *
 * @category   apps
 * @package    storage
 * @subpackage views
 * @author     ClearFoundation <developer@clearfoundation.com>
 * @copyright  2012 ClearFoundation
 * @license    http://www.gnu.org/copyleft/gpl.html GNU General Public License version 3 or later
 * @link       http://www.clearfoundation.com/docs/developer/apps/storage/
 */

///////////////////////////////////////////////////////////////////////////////
//
// This program is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// This program is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with this program.  If not, see <http://www.gnu.org/licenses/>.  
//  
///////////////////////////////////////////////////////////////////////////////

///////////////////////////////////////////////////////////////////////////////
// Load dependencies
///////////////////////////////////////////////////////////////////////////////

$this->lang->load('base');
$this->lang->load('storage');

///////////////////////////////////////////////////////////////////////////////
// Headers
///////////////////////////////////////////////////////////////////////////////

$headers = array(
    lang('storage_mapping'),
    lang('storage_store'),
    lang('base_status')
);

///////////////////////////////////////////////////////////////////////////////
// Anchors 
///////////////////////////////////////////////////////////////////////////////

$anchors = array();

///////////////////////////////////////////////////////////////////////////////
// Items
///////////////////////////////////////////////////////////////////////////////

foreach ($mapping_details as $details) {
    foreach ($details['mappings'] as $source => $store) {
        $source_encoded = strtr(base64_encode($source),  '+/=', '-_.');
        // FIXME: discuss icon strategy
        $state_icon = ($store['state_level'] == 'good') ?  '<span class="theme-icon-ok">&nbsp;</span>' : '<span class="theme-icon-fail">&nbsp;</span>';

        $item['title'] = $source;
        $item['action'] = '';
        $item['anchors'] = button_set(
            array(anchor_custom('/app/storage/mappings/view/' . $source_encoded, lang('base_view_details')))
        );
        $item['details'] = array(
            $details['name'],
            $store['store'],
            $state_icon
        );

        $items[] = $item;
    }
}

sort($items);

///////////////////////////////////////////////////////////////////////////////
// Summary table
///////////////////////////////////////////////////////////////////////////////

echo summary_table(
    lang('storage_mappings'),
    $anchors,
    $headers,
    $items
);
