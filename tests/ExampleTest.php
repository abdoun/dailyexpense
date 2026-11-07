<?php

namespace Tests\Feature;

use Tests\TestCase;

class ExampleTest extends TestCase
{
    public function test_homepage_is_available(): void
    {
        $this->get('/')
            ->assertOk()
            ->assertSee('This is an old project')
            ->assertSee('Dailyexpense is a Web Application')
            ->assertDontSee('&lt;br&gt;');
    }

    public function test_legacy_membership_url_is_available(): void
    {
        $this->get('/membership/login')
            ->assertOk()
            ->assertDontSee('This is an old project');
    }

    public function test_legacy_controller_root_url_is_available(): void
    {
        $this->get('/pages')->assertOk();
    }

    public function test_home_notice_is_not_shown_on_other_pages(): void
    {
        $this->get('/pages/contacts')
            ->assertOk()
            ->assertDontSee('This is an old project');
    }

    public function test_membership_captcha_refresh_url_is_available(): void
    {
        $this->get('/membership/imgcaptcha?refresh=0.12345')
            ->assertOk()
            ->assertHeader('content-type', 'image/png');
    }
}
