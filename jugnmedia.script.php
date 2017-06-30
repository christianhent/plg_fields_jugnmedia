<?php
defined('_JEXEC') or die('Restricted access');


class PlgFieldsJugnmediaInstallerScript
{

    public function preflight($type)
    {
        if ($type != "discover_install" && $type != "install")
        {
            return true;
        }

        $version = new JVersion;

        if (version_compare($version->getShortVersion(), "3.7.0", "<"))
        {
            Jerror::raiseWarning(null, JText::_('PLG_FIELDS_JUGNMEDIA_INSTALL_NOJ37_ERROR'));

            return false;
        }

    }

    public function install($parent)
    {
        jimport('joomla.filesystem.folder');
        jimport('joomla.filesystem.file');

        $path = $parent->getParent()->getPath('source');

        // check if /layouts/plugins/FIELDS exists, if not create it
        if (!JFolder::exists(JPATH_SITE . '/layouts/plugins/fields'))
        {
            JFolder::create(JPATH_SITE . '/layouts/plugins/fields');
        }

        $src = $path . '/layouts/jugnmedia';
        $dest = JPATH_SITE . '/layouts/plugins/fields/jugnmedia';
        $retVal = JFolder::move($src, $dest, '');


        if ($retVal !== true)
        {
            JError::raiseWarning(100, $retVal);
        }

        JFactory::getApplication()->enqueueMessage(JText::_('PLG_FIELDS_JUGNMEDIA_INSTALL_NOTICE'), 'notice');
    }

    public function update($parent)
    {
        jimport('joomla.filesystem.folder');
        jimport('joomla.filesystem.file');

        $path = $parent->getParent()->getPath('source');

        $src = $path . '/layouts/jugnmedia';
        $dest = JPATH_SITE . '/layouts/plugins/fields/jugnmedia';

        if (JFolder::exists($dest))
        {
            JFolder::delete($dest);
        }

        $retVal = JFolder::move($src, $dest, '');

        if ($retVal !== true)
        {
            JError::raiseWarning(100, $retVal);
        }

        JFactory::getApplication()->enqueueMessage(JText::_('PLG_FIELDS_JUGNMEDIA_UPDATE_NOTICE'), 'notice');
    }

    public function uninstall($parent)
    {
        jimport('joomla.filesystem.folder');
        jimport('joomla.filesystem.file');

        $folder = JPATH_SITE . '/layouts/plugins/fields/jugnmedia';

        if (JFolder::delete($folder))
        {
            JFactory::getApplication()->enqueueMessage(JText::_('PLG_FIELDS_JUGNMEDIA_LAYOUTS_DELETED_NOTICE'), 'notice');
        }
    }

    function postflight($type, $parent)
    {
        jimport('joomla.filesystem.folder');
        jimport('joomla.filesystem.file');

        $path = JPATH_SITE . '/plugins/fields/jugnmedia/layouts';

        if (JFolder::exists($path))
        {
            JFolder::delete($path);
        }

    }

}