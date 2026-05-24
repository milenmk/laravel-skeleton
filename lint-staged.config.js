/*
 * Copyright (c) 2025. Milen Karaganski (info@minkov.dev). All rights reserved.
 * This website (laragdpr.com) and its content are protected.
 */

export default {
    '**/*.php': [
        () => 'php vendor/bin/phpstan analyse --memory-limit=1024M',
        () => 'php vendor/bin/peck',
        () => 'php vendor/bin/pint',
    ],
    'resources/**/*.{blade.php,css,js,json,md,yml,yaml}': ['npm run prettier-fix --'],
}
