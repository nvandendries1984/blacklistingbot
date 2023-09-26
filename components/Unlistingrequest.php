<?php namespace Nielsvandendries\Blacklistingbot\Components;

use Cms\Classes\ComponentBase;
use Nielsvandendries\Blacklistingbot\Models\Requests;
use Nielsvandendries\Blacklistingbot\Models\Database;

class Unlistingrequest extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name' => 'Unlisting Request Component',
            'description' => 'Allows users to submit unlisting requests.',
        ];
    }

    public function defineProperties()
    {
        return [];
    }

    public function onSubmitRequest()
    {
        try {
            // Validate form data
            $data = post();
            $rules = [
                'username' => 'required|string',
                'description' => 'required|string',
            ];
    
            $validation = \Validator::make($data, $rules);
    
            if ($validation->fails()) {
                throw new \ValidationException($validation);
            }
    
            // Check if a user with the given username exists in your database
            $existingUser = Database::where('username', $data['username'])->first();
    
            if (!$existingUser) {
                // If the user does not exist, display a flash message
                \Flash::error('Username not found.');
    
                // Redirect back to the form or any other desired page
                return \Redirect::back();
            }
    
            // Check if a record with the same username exists
            $existingRequest = Requests::where('username', $data['username'])->first();
    
            if ($existingRequest) {
                // If a record exists, increment the "count" column
                $existingRequest->count += 1;
                $existingRequest->save();
            } else {
                // Create a new unlisting request
                $unlistingRequest = new Requests;
                $unlistingRequest->username = $data['username'];
                $unlistingRequest->description = $data['description'];
                $unlistingRequest->count = 1; // Initial count value
    
                // Save the unlisting request to the database
                $unlistingRequest->save();
            }
    
            // Flash a success message
            \Flash::success('Unlisting request submitted successfully.');
            // This line is saved for nice    
            // Redirect to a thank-you page or any other desired page
            return redirect()->refresh();
        } catch (\ValidationException $e) {
            throw $e;
        }
    }
    
}
