<?php

/**
 * imva.biz Devloper's Guide
 *
 *
 *
 * For redistribution in the provider's network only.
 *
 * Weitergabe außerhalb des Anbieternetzwerkes verboten.
 *
 * This software is intellectual property of imva.biz respectively of its author and is protected
 * by copyright law. This software product is provided "as it is" with no guarantee.
 * You are free to use this software and to modify it in order to fit your requirements.
 * Any modification, copying, redistribution, transmission outsitde of the provider's platforms
 * is a violation of the license agreement and will be prosecuted by civil and criminal law.
 * By applying and using this software product, you agree to the terms and conditions of use.
 *
 * Diese Software ist geistiges Eigentum von imva.biz respektive ihres Autors und ist durch das
 * Urheberrecht geschützt. Diese Software wird ohne irgendwelche Garantien und "wie sie ist"
 * angeboten.
 * Sie sind berechtigt, diese Software frei zu nutzen und auf Ihre Bedürfnisse anzupassen.
 * Jegliche Modifikation, Vervielfältigung, Redistribution, Übertragung zum Zwecke der
 * Weiterentwicklung außerhalb der Netzwerke des Anbieters ist untersagt und stellt einen Verstoß
 * gegen die Lizenzvereinbarung dar.
 * Mit der Übernahme dieser Software akzeptieren Sie die zwischen Ihnen und dem Herausgeber
 * festgehaltenen Bedingungen. Der Bruch dieser Bedingungen kann Schadensersatzforderungen nach
 * sich ziehen.
 *
 * (EULA-13/7-OS)
 *
 * (c) 2013-2020 imva.biz, Johannes Ackermann, ja@imva.biz
 * @author Johannes Ackermann
 *
 * 16/9/23-20/4/10
 * v 2.0.0
 */

namespace Imva\DevelopersGuide\Core;

class Base extends oxUbase
{



    /**
     * Delete contents from the Compile Dir.
     *
     * @param null
     * @return boolean
     */
    public function imva_clearTemp()
    {
        // Compile dir
        $tempdirPath = oxRegistry::getConfig()->getConfigParam('sCompileDir');

        // tmp
        if (!$this->_clearDir($tempdirPath))
        {
            return false;
        }

        // tmp/smarty
        if (file_exists($tempdirPath.'/smarty/'))
        {
            $this->_clearDir($tempdirPath.'/smarty/');
        }

        // tmp/css
        if (file_exists($tempdirPath.'/css/'))
        {
            $this->_clearDir($tempdirPath.'/css/');
        }

        // tmp/less
        if (file_exists($tempdirPath.'/less/'))
        {
            $this->_clearDir($tempdirPath.'/less/');
        }

        // Create new .htaccess
        $HtaccessFileInstance = fopen($tempdirPath.'/.htaccess','w+');
        fwrite($HtaccessFileInstance,"# disabling file access\n<FilesMatch .*>\norder allow,deny\ndeny from all\n</FilesMatch>\n\nOptions -Indexes\n");
        fclose($HtaccessFileInstance);

        // Return
        return true;
    }



    /**
     * Clean directory.
     *
     * @param string
     * @return boolean
     */
    private function _clearDir($pathToClear)
    {
        if (is_dir($pathToClear))
        {
            if ($DirectoryInstance = opendir($pathToClear))
            {
                while (($fileToDelete = readdir($DirectoryInstance)) !== false)
                {
                    if ($fileToDelete != '.' and $fileToDelete != '..')
                    {
                        // Suppress warnings.
                        @unlink($pathToClear.$fileToDelete);
                    }
                }
                closedir($DirectoryInstance);
            }
            return true;
        }
        else{
            return false;
        }
    }
}
