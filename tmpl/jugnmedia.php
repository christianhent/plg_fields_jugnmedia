<?php
/**
 * @package     Joomla.Plugin
 * @subpackage  Fields.Jugnmedia
 *
 * @copyright   Copyright (C) 2017 Christian Hent, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

jimport('joomla.filesystem.file');
jimport('joomla.filesystem.folder');

$value = $field->value;

if ($value == '')
{
    return;
}

$value = (array)$value;

foreach ($value as $file)
{
    if (!$file || $file == '-1')
    {
        continue;
    }

    $file = JFile::makeSafe($file);
    $ext = strtolower(JFile::getExt($file));
    $fPath = JPath::clean('images/' . $fieldParams->get('directory', '/') . '/' . $file);
    $lPath = JPATH_ROOT . '/plugins/fields/jugnmedia/layouts';

    if (JFile::exists($fPath))
    {
        if ($ext == 'mp3' || $ext == 'wav' || $ext == 'ogg' || $ext == 'oga')
        {
            echo JLayoutHelper::render('plugins.fields.jugnmedia.audio', $fPath, null, array('debug' => false));
        }

        if ($ext == 'ogv' || $ext == 'mp4' || $ext == 'webm')
        {
            $data = array(
                'fp' => $fPath,
                'vw' => $fieldParams->get('video_w'),
                'vh' => $fieldParams->get('video_h')
            );

            echo JLayoutHelper::render('plugins.fields.jugnmedia.' . $ext, $data, $lPath, array('debug' => false));
        }
    }
}
