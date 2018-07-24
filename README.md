# Publisher List Utility
Finds a list of apps created by a developer or publisher and allows you to add them to your Barter.vg list(s).

## Requirements
* A web server
* PHP 7.0+ (may work on 5.x but hasn't been tested)
* `allow_url_fopen = 1`
* `php-xml`

## Installing
Drop the PHP file somewhere on your Web server. Yeah, that's it.

## Recommendations/warnings
I'd advise against running this in a production environment. There is virtually no input/output sanitation so depending on Steam Store entries you may find a glorious XSS, or a DoS attempt at the Steam Store. Use at your own risk, and not without modification.

## License
```
Copyright 2018 Alexandra Frock

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
```
