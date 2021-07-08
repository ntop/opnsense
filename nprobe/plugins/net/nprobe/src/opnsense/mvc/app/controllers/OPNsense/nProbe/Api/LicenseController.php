<?php

/**
 *    Copyright (C) 2020 ntop
 *
 *    All rights reserved.
 *
 *    Redistribution and use in source and binary forms, with or without
 *    modification, are permitted provided that the following conditions are met:
 *
 *    1. Redistributions of source code must retain the above copyright notice,
 *       this list of conditions and the following disclaimer.
 *
 *    2. Redistributions in binary form must reproduce the above copyright
 *       notice, this list of conditions and the following disclaimer in the
 *       documentation and/or other materials provided with the distribution.
 *
 *    THIS SOFTWARE IS PROVIDED ``AS IS'' AND ANY EXPRESS OR IMPLIED WARRANTIES,
 *    INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY
 *    AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE
 *    AUTHOR BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY,
 *    OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF
 *    SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS
 *    INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN
 *    CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE)
 *    ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE
 *    POSSIBILITY OF SUCH DAMAGE.
 *
 */

namespace OPNsense\nProbe\Api;

use OPNsense\Base\ApiMutableModelControllerBase;
use OPNsense\Core\Backend;

/**
 * Class LicenseController
 * @package OPNsense\nProbe
 */
class LicenseController extends ApiMutableModelControllerBase
{
    protected static $internalModelClass = '\OPNsense\nProbe\License';
    protected static $internalModelName = 'license';
    
    public function infoAction()
    {
        if ($this->request->isPost()) {
	    /* $param   = $this->request->getPost('param-name'); */

            $backend = new Backend();

            $version = $backend->configdpRun(
                "nprobe",
                array("version")
            );

	    $system_id = $backend->configdpRun(
                "nprobe",
                array("systemid")
            );

	    $edition = $backend->configdpRun(
                "nprobe",
                array("edition")
	    );

	    $license_status = $backend->configdpRun(
                "nprobe",
                array("license")
            );

	    $maintenance = $backend->configdpRun(
                "nprobe",
                array("maintenance")
            );

            return array(
	        "version" => $version,
	        "systemid" => $system_id,
	        "edition" => $edition,
	        "license" => $license_status,
	        "maintenance" => $maintenance
	    );
        }

        return array("message" => "Unable to run logs action");
    }
}
