<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use function Pest\Laravel\get;

beforeEach(function () {
    $this->user = User::factory()->create();
    $this->actingAs($this->user);
});

it('should be able to download a exel document', function () {
    get(route('transactions.xls-export'))->assertOk()->assertViewIs('pages.transactions.transactions-to-xls.blade');
});