<?php

class ValidateController
{

    public function validateInsert($image, $nama, $deskripsi)
    {
        $errors = [];

        // Validate image
        if (empty($image)) {
            $errors[] = "Image is required.";
        } else {
            $allowedExtensions = ['png', 'jpg', 'jpeg'];
            $fileExtension = strtolower(pathinfo($image, PATHINFO_EXTENSION));

            if (!in_array($fileExtension, $allowedExtensions)) {
                $errors[] = "Invalid image file type. Allowed types: PNG, JPG, JPEG.";
            }
        }

        // Validasi
        if (empty($nama)) {
            $errors[] = "Nama is required.";
        }

        if (empty($deskripsi)) {
            $errors[] = "Deskripsi is required.";
        }

        return $errors;
    }
    
}
