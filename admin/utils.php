<?php
/**
 * Shared utility functions for admin panel
 */

/**
 * Escape HTML to prevent XSS attacks
 * @param string $string The string to escape
 * @return string The escaped string
 */
function h($string) {
    return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
}

/**
 * Validate book form data
 * @param array $data POST data to validate
 * @param array $categories Available categories for validation
 * @return array Array with 'valid' boolean and 'error' message if invalid
 */
function validateBookData($data, $categories) {
    $requiredFields = ['title', 'cover', 'author', 'description', 'category'];
    
    // Check required fields
    foreach ($requiredFields as $field) {
        if (!isset($data[$field]) || trim($data[$field]) === '') {
            return ['valid' => false, 'error' => "请填写所有必填字段"];
        }
    }
    
    // Validate category
    $category = filter_var($data['category'], FILTER_VALIDATE_INT);
    if ($category === false || $category < 0 || $category >= count($categories)) {
        return ['valid' => false, 'error' => "请选择有效的分类"];
    }
    
    return ['valid' => true];
}

/**
 * Sanitize book form data
 * @param array $data POST data to sanitize
 * @return array Sanitized data
 */
function sanitizeBookData($data) {
    return [
        'title' => trim($data['title']),
        'cover' => trim($data['cover']),
        'author' => trim($data['author']),
        'description' => trim($data['description']),
        'category' => (int)$data['category'],
        'serial' => isset($data['serial']) ? 1 : 0
    ];
}

/**
 * Generate category dropdown options
 * @param array $categories Array of category names
 * @param int $selectedCategory Currently selected category index (optional)
 * @return string HTML options for dropdown
 */
function generateCategoryOptions($categories, $selectedCategory = null) {
    $options = '';
    for ($i = 0; $i < count($categories); $i++) {
        $selected = ($selectedCategory === $i) ? 'selected' : '';
        $options .= '<option value="' . $i . '" ' . $selected . '>' . h($categories[$i]) . '</option>';
    }
    return $options;
}

/**
 * Generate category dropdown items for Semantic UI
 * @param array $categories Array of category names
 * @param int $selectedCategory Currently selected category index (optional)
 * @return string HTML items for dropdown
 */
function generateCategoryItems($categories, $selectedCategory = null) {
    $items = '';
    for ($i = 0; $i < count($categories); $i++) {
        $active = ($selectedCategory === $i) ? 'active selected' : '';
        $items .= '<div class="item ' . $active . '" data-value="' . $i . '">' . h($categories[$i]) . '</div>';
    }
    return $items;
}