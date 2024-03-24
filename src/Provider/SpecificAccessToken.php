<?php

namespace Stevenmaguire\OAuth2\Client\Provider;

class SpecificAccessToken extends \League\OAuth2\Client\Token\AccessToken
{
    protected ?int $refreshExpires = null;

    public function __construct(array $options = [])
    {
        parent::__construct($options);
        
        if (isset($options['refresh_expires']) && is_numeric($options['refresh_expires'])) {
            $this->refreshExpires = $options['refresh_expires'];
        } elseif (isset($options['refresh_expires_in']) && is_numeric($options['refresh_expires_in'])) {
            $this->refreshExpires = $options['refresh_expires_in'] != 0 ? $this->getTimeNow() + $options['refresh_expires_in'] : 0;
            $this->values['refresh_expires'] = $this->refreshExpires;
        }
    }

    public function getRefreshExpires(): ?int
    {
        return $this->refreshExpires;
    }
}
