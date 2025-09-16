<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class ImageController extends BaseController
{
public function show($filename)
{
    // Sanitize the filename
    $filename = basename($filename);

    // ===================================================================
    // ENHANCEMENT: Use DIRECTORY_SEPARATOR for better OS compatibility
    // ===================================================================
    $path = ROOTPATH . 'uploads' . DIRECTORY_SEPARATOR . $filename;

    // Log the corrected, OS-specific path
    log_message('debug', 'Attempting to serve image from path: ' . $path);

    // Check if the file exists and is readable
    if (!is_file($path) || !is_readable($path)) {
        if (!is_file($path)) {
            log_message('error', 'Image not found at path: ' . $path);
        } else {
            log_message('error', 'Image found but not readable at path (check permissions): ' . $path);
        }
        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
    }

    // Get the file's mime type
    $mime = mime_content_type($path);
      
    // Set the HTTP headers
    $this->response->setHeader('Content-Type', $mime);
    $this->response->setHeader('Content-Length', filesize($path)); // Good practice to add this

    // ===================================================================
    // ENHANCEMENT: Check the result of readfile()
    // ===================================================================
    // Flush any output buffers before sending the file
    if (ob_get_level()) {
        ob_end_clean();
    }

    $bytesSent = readfile($path);

    if ($bytesSent === false) {
        log_message('error', 'readfile() failed for path: ' . $path);
        // You might want to handle this error, but for now, logging is key
    } else {
        log_message('debug', "Successfully sent {$bytesSent} bytes for file: " . $filename);
    }
    
    exit();
}
}
