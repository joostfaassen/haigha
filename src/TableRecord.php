<?php

namespace Haigha;

use RuntimeException;

class TableRecord
{
    // @codingStandardsIgnoreStart
    private $__meta = array();
    // @codingStandardsIgnoreEnd
    
    public function __construct($tablename)
    {
        $this->__meta['tablename'] = $tablename;
    }

    public function __call($key, $params)
    {
        if (substr($key, 0, 3) == 'set') {
            $var = lcfirst(substr($key, 3));
            $value = $params[0];
            if ($value instanceof \DateTime) {
                $value = $value->getTimeStamp();
            }
            //echo "SETVAR:" . $var . "\n";
            $this->$var = $value;
        } else {
            throw new RuntimeException("Unexpected key passed to magic call to TableRecord: $key");
        }
    }

    
    public function __meta($key)
    {
        return $this->__meta[$key];
    }
}
