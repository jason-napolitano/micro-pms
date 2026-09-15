# MicroPMS

> A lightweight property management system. The application has a property manager, unit manager, floor plan manager, 
> vendor manager and make-ready board. MicroPMS is built with Laravel 13, VueJS, Inertia and Element Plus and comes with roles 
> and permissions for authorization using `spatie/laravel-permission`. Future iterations will include work order management, 
> inspections and other mainstream property management features.

## Installation

```bash
$ cp .env.example .env
```

```bash
$ composer install
```

```bash
$ npm i
```

```bash
$ php artisan key:generate
```

```bash
$ php artisan storage:link
```

```bash
$ php artisan migrate:fresh --seed
```

### MIT License
Copyright (c) 2026 Jason Napolitano

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.
