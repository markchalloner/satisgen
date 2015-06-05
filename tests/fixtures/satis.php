<?php

$name = $config->getConfig('NAME', 'the Satis name', null, function($answer) {
    if (0 === strlen($answer)) {
        throw new \RuntimeException(
            'The name must be entered'
        );
    }
    return $answer;
});

$domain = $config->getConfig('DOMAIN', 'the Satis domain (without http(s)://)', null, function($answer) {
    if (0 === strlen($answer)) {
        throw new \RuntimeException(
            'The domain must be entered'
        );
    }
    if (preg_match('#^https?://#', $answer)) {
        throw new \RuntimeException(
            'The domain should not begin with http:// or https://'
        );
    }
    return $answer;
});

$licence = $config->getConfig('LICENCE', 'your licence key', null, function($answer) {
    if (16 !== strlen($answer)) {
        throw new \RuntimeException(
            'The licence should be 16 characters long'
        );
    }
    if (1 === preg_match('/[^a-f0-9]/i', $answer)) {
        throw new \RuntimeException(
            'The licence should include hexadecimal characters only'
        );
    }
    return $answer;
}, true);

?>
{
    "name": "<?php echo $name ?>",
    "homepage": "https://<?php echo $domain ?>",
    "archive": {
        "directory": "dist",
        "format": "zip",
        "prefix-url": "https://<?php echo $config->getConfig('DOMAIN', 'the Satis domain (without https://)') ?>",
        "skip-dev": true
    },
    "repositories": [
        {
            "_comment": "Custom package", 
            "type": "package",
            "package": {
                "name": "vendor/package",
                "version": "1.0.0",
                "type": "wordpress-plugin",
                "dist": {
                    "type": "zip",
                    "url": "http://www.custom.com/download?licence=<?php echo $licence ?>"
                }
            }
        },
    ],
    "require-all": true
}
