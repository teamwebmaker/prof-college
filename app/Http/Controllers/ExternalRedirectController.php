<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;

class ExternalRedirectController extends Controller
{

    /**
     * Redirect to geo library in new tab
     */
    public function library(): Response
    {
        return $this->openInNewTab('https://geolibrary.byethost3.com/gldani/opac/index.php');
    }

    /**
     * Redirect to Google in new tab
     */
    public function google(): Response
    {
        return $this->openInNewTab('https://www.google.com');
    }

    /**
     * Redirect to GitHub in new tab
     */
    public function github(): Response
    {
        return $this->openInNewTab('https://www.github.com');
    }

    /**
     * Redirect to Twitter in new tab
     */
    public function twitter(): Response
    {
        return $this->openInNewTab('https://www.twitter.com');
    }

    /**
     * Redirect to your company's external site in new tab
     */
    public function companySite(): Response
    {
        return $this->openInNewTab('https://www.yourcompany.com');
    }

    /**
     * Protected method to handle opening in new tab
     */
    protected function openInNewTab(string $url): Response
    {
        if (!$this->isValidUrl($url)) {
            abort(400, 'Invalid URL');
        }

        return response(view('pages.external_redirect', ['url' => $url]));
    }

    /**
     * Validate the URL structure
     */
    protected function isValidUrl(string $url): bool
    {
        return filter_var($url, FILTER_VALIDATE_URL) !== false &&
            in_array(parse_url($url, PHP_URL_SCHEME), ['http', 'https']);
    }
}
