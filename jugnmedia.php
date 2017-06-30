<?php
/**
 * @package     Joomla.Plugin
 * @subpackage  Fields.Jugnmedia
 *
 * @copyright   Copyright (C) 2017 Christian Hent, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

JLoader::import('components.com_fields.libraries.fieldslistplugin', JPATH_ADMINISTRATOR);


class PlgFieldsJugnmedia extends FieldsListPlugin
{
    public function onCustomFieldsPrepareDom($field, DOMElement $parent, JForm $form)
    {
        $fieldNode = parent::onCustomFieldsPrepareDom($field, $parent, $form);

        if (!$fieldNode)
        {
            return $fieldNode;
        }

        $fieldNode->setAttribute('type', 'filelist');

        $fieldNode->setAttribute('directory', '/images/' . $fieldNode->getAttribute('directory'));

        $fieldNode->setAttribute('filter', '\.mp4$|\.webm$|\.ogg$|\.ogv$|\.mp3$|\.wav$');

        $fieldNode->setAttribute('hide_none', false);

        $fieldNode->setAttribute('hide_default', true);

        $fieldNode->setAttribute('label', 'PLG_FIELDS_JUGNMEDIA_FIELD_LABEL');

        $fieldNode->setAttribute('description', 'PLG_FIELDS_JUGNMEDIA_FIELD_DESC');

        return $fieldNode;
    }
}
