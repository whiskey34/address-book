<?php

namespace Tests\Feature;

use App\Models\Contact;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ContactControllerTest extends TestCase
{
    use RefreshDatabase; // Ensure a clean database for each test
    
    public function test_store_method()
    {
        // Create a fake contact data
        $contactData = [
            'name' => 'John Doe',
            'phone' => '1234567890',
            'email' => 'john@example.com',
            'address' => '123 Main St',
            'city' => 'Anytown',
        ];

        // Send a POST request to the endpoint with the fake data
        $response = $this->post('/api/contacts', $contactData);
        
        // Assert that the response status is 201 (Created)
        $response->assertStatus(201);
        
        // Assert that the contact was stored in the database
        $this->assertDatabaseHas('contacts', $contactData);
    }

    public function testUpdateContact()
    {
        // Create a contact in the database
        $contact = Contact::factory()->create();
    
        // Send a PUT or PATCH request to update the contact
        $response = $this->putJson('/api/contacts/' . $contact->id, [
            'name' => 'Updated Name',
            'phone' => '1234567890123', // 13-digit phone number
            'email' => 'updated@example.com',
            'address' => 'Updated Address',
            'city' => 'Updated City',
        ]);
        
        // Assert that the request was successful
        $response->assertOk();
    }
    



public function testDeleteContact()
{
    // Create a contact in the database
    $contact = Contact::factory()->create();

    // Send a DELETE request to delete the contact
    $response = $this->deleteJson('/api/contacts/' . $contact->id);

    // Assert that the request was successful
    $response->assertStatus(200); // No content

    // Assert that the contact was deleted from the database
    $this->assertDatabaseMissing('contacts', ['id' => $contact->id]);
}



}
