<?php
/* Copyright (C) 2023 EVARISK <technique@evarisk.com>
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <https://www.gnu.org/licenses/>.
 */

/**
 * \file    lib/easycrm.lib.php
 * \ingroup easycrm
 * \brief   Library files with common functions for EasyCRM
 */

/**
 * Prepare admin pages header
 *
 * @return array
 */
function easycrm_admin_prepare_head(): array
{
    // Global variables definitions
    global $langs, $conf;

    // Load translation files required by the page
    saturne_load_langs();

    // Initialize values
    $h = 0;
    $head = [];

    $head[$h][0] = dol_buildpath('/easycrm/admin/setup.php', 1);
    $head[$h][1] = '<i class="fas fa-cog pictofixedwidth"></i>' . $langs->trans('ModuleSettings');
    $head[$h][2] = 'settings';
    $h++;

    $head[$h][0] = dol_buildpath('/easycrm/admin/address.php', 1);
    $head[$h][1] = '<i class="fas fa-map-marker-alt pictofixedwidth"></i>' . $langs->trans('Addresses');
    $head[$h][2] = 'address';
    $h++;

    $head[$h][0] = dol_buildpath('/easycrm/admin/about.php', 1);
    $head[$h][1] = '<i class="fab fa-readme pictofixedwidth"></i>' . $langs->trans('About');
    $head[$h][2] = 'about';
    $h++;


    complete_head_from_modules($conf, $langs, null, $head, $h, 'easycrm@easycrm');

    complete_head_from_modules($conf, $langs, null, $head, $h, 'easycrm@easycrm', 'remove');

    return $head;
}

/**
 * Get signable dolibarr objects
 *
 * @return array
 */
function easycrm_get_signable_objects(): array
{
    $objectsMetadata = [];

    if (isModEnabled('propal')) {
        $objectsMetadata['propal'] = [
            'mainmenu'      => 'commercial',
            'leftmenu'      => 'propals',
            'langs'         => 'Proposal',
            'langfile'      => 'propal',
            'picto'         => 'propal',
            'class_name'    => 'Propal',
            'post_name'     => 'fk_propal',
            'link_name'     => 'propal',
            'tab_type'      => 'propal',
            'table_element' => 'propal',
            'name_field'    => 'ref',
            'create_url'    => 'comm/propal/card.php',
            'class_path'    => 'comm/propal/class/propal.class.php',
            'lib_path'      => 'core/lib/propal.lib.php',
        ];
    }

    if (isModEnabled('facture')) {
        $objectsMetadata['invoice'] = [
            'mainmenu'      => 'billing',
            'leftmenu'      => 'customers_bills',
            'langs'         => 'Invoice',
            'langfile'      => 'bills',
            'picto'         => 'bill',
            'class_name'    => 'Facture',
            'post_name'     => 'fk_invoice',
            'link_name'     => 'facture',
            'tab_type'      => 'invoice',
            'table_element' => 'facture',
            'name_field'    => 'ref',
            'create_url'    => 'compta/facture/card.php',
            'class_path'    => 'compta/facture/class/facture.class.php',
            'lib_path'      => 'core/lib/invoice.lib.php',
        ];
    }

    if (isModEnabled('order')) {
        $objectsMetadata['order'] = [
            'mainmenu'      => 'billing',
            'leftmenu'      => 'orders',
            'langs'         => 'Order',
            'langfile'      => 'orders',
            'picto'         => 'order',
            'class_name'    => 'Commande',
            'post_name'     => 'fk_order',
            'link_name'     => 'commande',
            'tab_type'      => 'order',
            'table_element' => 'commande',
            'name_field'    => 'ref',
            'create_url'    => 'commande/card.php',
            'class_path'    => 'commande/class/commande.class.php',
            'lib_path'      => 'core/lib/order.lib.php',
        ];
    }
    return $objectsMetadata;
}
