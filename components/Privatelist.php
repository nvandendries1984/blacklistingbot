<?php namespace Nielsvandendries\Blacklistingbot\Components;

use Cms\Classes\ComponentBase;
use Nielsvandendries\Blacklistingbot\Models\Privatedatabasemodel;
use Flash; // Make sure to import the Flash class

class Privatelist extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name' => 'Privatelist Component',
            'description' => 'This is the private part'
        ];
    }

    public function defineProperties()
    {
        return [];
    }

    public function onSubmitForm()
    {
        $username = post('username');

        // Check if the username already exists
        $existingRegistration = Privatedatabasemodel::where('username', $username)->first();
    
        if ($existingRegistration) {
            // Update the existing registration's description, tags, and count
            $existingRegistration->description = post('description');
            $existingRegistration->tags = post('tags');
            $existingRegistration->count += 1; // Increase the count by 1
            $existingRegistration->save();
    
            Flash::success('Registration updated successfully.');
        } else {
            // Create a new registration with count as 1
            $registration = new Privatedatabasemodel();
            $registration->username = $username;
            $registration->description = post('description');
            $registration->tags = post('tags');
            $registration->count = 1; // Initialize the count
            $registration->save();
    
            Flash::success('Registration saved successfully.');
        }

        // Optioneel: vernieuw de pagina of voer andere acties uit
        return redirect()->refresh();
    }
}
