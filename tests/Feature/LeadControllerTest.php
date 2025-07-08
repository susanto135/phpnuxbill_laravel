<?php

namespace Tests\Feature;

use Tests\TestCase;

class LeadControllerTest extends TestCase
{
    public function test_leads_index_page_loads(): void
    {
        $response = $this->withoutMiddleware()->get('/admin/leads');
        $response->assertStatus(200);
    }
}
