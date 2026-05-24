/*
 * Copyright (c) 2025. Milen Karaganski (info@minkov.dev). All rights reserved.
 * This website (laragdpr.com) and its content are protected.
 */

import axios from 'axios'

window.axios = axios

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest'
