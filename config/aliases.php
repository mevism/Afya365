<?php

return [
    '@bower'          =>   '@vendor/bower-asset',
    '@npm'            =>   '@vendor/npm-asset',
    '@oa'             =>   '@app',
    '@controllers'    =>   '@oa/apps/controllers',
    '@components'     =>   '@oa/apps/components',
    '@config'         =>   '@oa/config',
    '@routes'         =>   '@oa/apps/routes',
    '@models'         =>   '@oa/apps/models',
    '@doctor'         =>   '@models/doctor',
    '@custom'         =>   '@models/main',
    '@userModels'     =>   '@custom/custom',
    '@search'         =>   '@custom/search',
    '@forms'          =>   '@custom/forms',
    '@customModels'   =>   '@models/admin',
    'adminModels'     =>   '@customModels/custom',
    '@department'     =>   '@adminModels/department',
    '@adminSearch'    =>   '@customModels/search',
    '@doctor'         =>   '@models/doctor',
    '@modules'        =>   '@oa/modules',
];