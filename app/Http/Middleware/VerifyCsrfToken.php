<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        "/admin/checkCurrentPass",
        "/admin/update-section-status",
        "/admin/update-category-status",
        "/admin/categoriesLevel",
        "/admin/update-product-status",
        "/admin/update-attribute-status",
        "/admin/update-productImage-status",
        "/admin/update-brand-status",
        "/admin/update-banner-status",
        "/admin/update-coupon-status",
    ];
}
