<?php

/**
 * Comprehensive Image Fix Script
 * Checks and fixes all possible image issues in the application
 */

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\{Menu, Promo, GalleryImage};
use Illuminate\Support\Facades\File;

echo "CHECKING AND FIXING ALL IMAGE ISSUES...\n";
echo str_repeat("=", 60) . "\n\n";

// ============================================
// 1. CHECK FOLDER STRUCTURE
// ============================================
echo "[STEP 1] Checking Folder Structure...\n";
echo str_repeat("-", 60) . "\n";

$requiredFolders = [
    'public/uploads',
    'public/uploads/menus',
    'public/uploads/promos',
    'public/uploads/gallery',
    'public/img',
    'storage/app/public',
];

$foldersCreated = 0;
foreach ($requiredFolders as $folder) {
    $fullPath = base_path($folder);
    if (!File::exists($fullPath)) {
        File::makeDirectory($fullPath, 0755, true);
        echo "  [OK] Created: {$folder}\n";
        $foldersCreated++;
    } else {
        echo "  [OK] Exists: {$folder}\n";
    }
}

if ($foldersCreated > 0) {
    echo "  [INFO] Created {$foldersCreated} missing folder(s)\n";
}
echo "\n";

// ============================================
// 2. CHECK AND FIX FILE PERMISSIONS
// ============================================
echo "[STEP 2] Checking File Permissions...\n";
echo str_repeat("-", 60) . "\n";

$folderToCheck = [
    'public/uploads',
    'public/img',
    'storage/app/public',
];

foreach ($folderToCheck as $folder) {
    $fullPath = base_path($folder);
    if (File::exists($fullPath)) {
        $perms = substr(sprintf('%o', fileperms($fullPath)), -4);
        echo "  [FOLDER] {$folder}: {$perms}\n";
        
        // Try to fix permission
        if (!is_writable($fullPath)) {
            @chmod($fullPath, 0755);
            echo "    [WARNING] Not writable, attempting to fix...\n";
        }
    }
}
echo "\n";

// ============================================
// 3. CHECK DATABASE PATHS
// ============================================
echo "[STEP 3] Checking Database Image Paths...\n";
echo str_repeat("-", 60) . "\n";

// Check Menus
$menuIssues = 0;
$menus = Menu::whereNotNull('image')->get();
echo "  [MENU] Checking {$menus->count()} menu items...\n";

foreach ($menus as $menu) {
    $originalPath = $menu->image;
    $issues = [];
    
    // Check if path starts with problematic prefixes
    if (str_starts_with($originalPath, 'storage/storage/')) {
        $issues[] = 'Double storage prefix';
        $menu->image = str_replace('storage/storage/', 'uploads/', $originalPath);
    } elseif (str_starts_with($originalPath, 'storage/')) {
        $issues[] = 'Storage prefix (should be uploads)';
        $menu->image = str_replace('storage/', 'uploads/', $originalPath);
    }
    
    // Check if file exists
    $filePath = public_path($menu->image);
    if (!File::exists($filePath)) {
        $issues[] = 'File not found';
        
        // Try to find in storage/app/public
        $alternativePath = storage_path('app/public/' . basename($menu->image));
        if (File::exists($alternativePath)) {
            // Copy to public/uploads/menus
            $newPath = 'uploads/menus/' . basename($menu->image);
            $newFullPath = public_path($newPath);
            File::copy($alternativePath, $newFullPath);
            $menu->image = $newPath;
            $issues[] = 'Copied from storage to uploads';
        }
    }
    
    if (!empty($issues)) {
        $menu->save();
        echo "    [FIX] Menu #{$menu->id} ({$menu->name}):\n";
        echo "       Old: {$originalPath}\n";
        echo "       New: {$menu->image}\n";
        echo "       Issues: " . implode(', ', $issues) . "\n";
        $menuIssues++;
    }
}

echo "  [RESULT] Fixed {$menuIssues} menu image issue(s)\n\n";

// Check Promos
$promoIssues = 0;
$promos = Promo::whereNotNull('image')->get();
echo "  [PROMO] Checking {$promos->count()} promo items...\n";

foreach ($promos as $promo) {
    $originalPath = $promo->image;
    $issues = [];
    
    if (str_starts_with($originalPath, 'storage/storage/')) {
        $issues[] = 'Double storage prefix';
        $promo->image = str_replace('storage/storage/', 'uploads/', $originalPath);
    } elseif (str_starts_with($originalPath, 'storage/')) {
        $issues[] = 'Storage prefix (should be uploads)';
        $promo->image = str_replace('storage/', 'uploads/', $originalPath);
    }
    
    $filePath = public_path($promo->image);
    if (!File::exists($filePath)) {
        $issues[] = 'File not found';
        
        $alternativePath = storage_path('app/public/' . basename($promo->image));
        if (File::exists($alternativePath)) {
            $newPath = 'uploads/promos/' . basename($promo->image);
            $newFullPath = public_path($newPath);
            File::copy($alternativePath, $newFullPath);
            $promo->image = $newPath;
            $issues[] = 'Copied from storage to uploads';
        }
    }
    
    if (!empty($issues)) {
        $promo->save();
        echo "    [FIX] Promo #{$promo->id} ({$promo->title}):\n";
        echo "       Old: {$originalPath}\n";
        echo "       New: {$promo->image}\n";
        echo "       Issues: " . implode(', ', $issues) . "\n";
        $promoIssues++;
    }
}

echo "  [RESULT] Fixed {$promoIssues} promo image issue(s)\n\n";

// Check Gallery
$galleryIssues = 0;
$galleries = GalleryImage::whereNotNull('image_path')->get();
echo "  [GALLERY] Checking {$galleries->count()} gallery items...\n";

foreach ($galleries as $gallery) {
    $originalPath = $gallery->image_path;
    $issues = [];
    
    if (str_starts_with($originalPath, 'storage/storage/')) {
        $issues[] = 'Double storage prefix';
        $gallery->image_path = str_replace('storage/storage/', 'uploads/', $originalPath);
    } elseif (str_starts_with($originalPath, 'storage/')) {
        $issues[] = 'Storage prefix (should be uploads)';
        $gallery->image_path = str_replace('storage/', 'uploads/', $originalPath);
    }
    
    $filePath = public_path($gallery->image_path);
    if (!File::exists($filePath)) {
        $issues[] = 'File not found';
        
        $alternativePath = storage_path('app/public/' . basename($gallery->image_path));
        if (File::exists($alternativePath)) {
            $newPath = 'uploads/gallery/' . basename($gallery->image_path);
            $newFullPath = public_path($newPath);
            File::copy($alternativePath, $newFullPath);
            $gallery->image_path = $newPath;
            $issues[] = 'Copied from storage to uploads';
        }
    }
    
    if (!empty($issues)) {
        $gallery->save();
        echo "    [FIX] Gallery #{$gallery->id}:\n";
        echo "       Old: {$originalPath}\n";
        echo "       New: {$gallery->image_path}\n";
        echo "       Issues: " . implode(', ', $issues) . "\n";
        $galleryIssues++;
    }
}

echo "  [RESULT] Fixed {$galleryIssues} gallery image issue(s)\n\n";

// ============================================
// 4. CHECK MISSING FILES
// ============================================
echo "[STEP 4] Checking Missing Image Files...\n";
echo str_repeat("-", 60) . "\n";

$missingMenus = [];
$missingPromos = [];
$missingGalleries = [];

foreach (Menu::whereNotNull('image')->get() as $menu) {
    if (!File::exists(public_path($menu->image))) {
        $missingMenus[] = [
            'id' => $menu->id,
            'name' => $menu->name,
            'path' => $menu->image,
        ];
    }
}

foreach (Promo::whereNotNull('image')->get() as $promo) {
    if (!File::exists(public_path($promo->image))) {
        $missingPromos[] = [
            'id' => $promo->id,
            'title' => $promo->title,
            'path' => $promo->image,
        ];
    }
}

foreach (GalleryImage::whereNotNull('image_path')->get() as $gallery) {
    if (!File::exists(public_path($gallery->image_path))) {
        $missingGalleries[] = [
            'id' => $gallery->id,
            'path' => $gallery->image_path,
        ];
    }
}

if (!empty($missingMenus)) {
    echo "  [WARNING] Missing Menu Images:\n";
    foreach ($missingMenus as $item) {
        echo "     - Menu #{$item['id']}: {$item['name']}\n";
        echo "       Path: {$item['path']}\n";
    }
}

if (!empty($missingPromos)) {
    echo "  [WARNING] Missing Promo Images:\n";
    foreach ($missingPromos as $item) {
        echo "     - Promo #{$item['id']}: {$item['title']}\n";
        echo "       Path: {$item['path']}\n";
    }
}

if (!empty($missingGalleries)) {
    echo "  [WARNING] Missing Gallery Images:\n";
    foreach ($missingGalleries as $item) {
        echo "     - Gallery #{$item['id']}\n";
        echo "       Path: {$item['path']}\n";
    }
}

if (empty($missingMenus) && empty($missingPromos) && empty($missingGalleries)) {
    echo "  [OK] All database images have corresponding files!\n";
} else {
    echo "\n  [TIP] Copy missing image files to the correct folders:\n";
    echo "     - Menu images → public/uploads/menus/\n";
    echo "     - Promo images → public/uploads/promos/\n";
    echo "     - Gallery images → public/uploads/gallery/\n";
}

echo "\n";

// ============================================
// 5. CHECK ORPHANED FILES
// ============================================
echo "[STEP 5] Checking Orphaned Files...\n";
echo str_repeat("-", 60) . "\n";

$menuFiles = File::files(public_path('uploads/menus'));
$promoFiles = File::files(public_path('uploads/promos'));
$galleryFiles = File::files(public_path('uploads/gallery'));

$dbMenuImages = Menu::pluck('image')->map(fn($p) => basename($p))->toArray();
$dbPromoImages = Promo::pluck('image')->map(fn($p) => basename($p))->toArray();
$dbGalleryImages = GalleryImage::pluck('image_path')->map(fn($p) => basename($p))->toArray();

$orphanedMenus = 0;
$orphanedPromos = 0;
$orphanedGalleries = 0;

foreach ($menuFiles as $file) {
    if (!in_array($file->getFilename(), $dbMenuImages)) {
        $orphanedMenus++;
    }
}

foreach ($promoFiles as $file) {
    if (!in_array($file->getFilename(), $dbPromoImages)) {
        $orphanedPromos++;
    }
}

foreach ($galleryFiles as $file) {
    if (!in_array($file->getFilename(), $dbGalleryImages)) {
        $orphanedGalleries++;
    }
}

echo "  [RESULT] Found {$orphanedMenus} orphaned menu image(s)\n";
echo "  [RESULT] Found {$orphanedPromos} orphaned promo image(s)\n";
echo "  [RESULT] Found {$orphanedGalleries} orphaned gallery image(s)\n";

if ($orphanedMenus + $orphanedPromos + $orphanedGalleries > 0) {
    echo "  [INFO] These files exist but not in database (safe to keep or delete)\n";
}

echo "\n";

// ============================================
// 6. SUMMARY
// ============================================
echo "[SUMMARY]\n";
echo str_repeat("=", 60) . "\n";

$totalMenus = Menu::whereNotNull('image')->count();
$totalPromos = Promo::whereNotNull('image')->count();
$totalGalleries = GalleryImage::whereNotNull('image_path')->count();

$workingMenus = $totalMenus - count($missingMenus);
$workingPromos = $totalPromos - count($missingPromos);
$workingGalleries = $totalGalleries - count($missingGalleries);

echo "  Menus: {$workingMenus}/{$totalMenus} working (" . round($workingMenus/$totalMenus*100, 1) . "%)\n";
echo "  Promos: {$workingPromos}/{$totalPromos} working (" . round($workingPromos/$totalPromos*100, 1) . "%)\n";
echo "  Galleries: {$workingGalleries}/{$totalGalleries} working (" . round($workingGalleries/$totalGalleries*100, 1) . "%)\n";

echo "\n";
echo "  [OK] Folders created/checked: " . count($requiredFolders) . "\n";
echo "  [OK] Menu paths fixed: {$menuIssues}\n";
echo "  [OK] Promo paths fixed: {$promoIssues}\n";
echo "  [OK] Gallery paths fixed: {$galleryIssues}\n";

$totalIssuesFixed = $menuIssues + $promoIssues + $galleryIssues + $foldersCreated;

echo "\n";
if ($totalIssuesFixed > 0) {
    echo "[SUCCESS] TOTAL ISSUES FIXED: {$totalIssuesFixed}\n";
} else {
    echo "[SUCCESS] NO ISSUES FOUND - Everything looks good!\n";
}

echo "\n";
echo "[NEXT STEPS]\n";
echo str_repeat("-", 60) . "\n";

if (!empty($missingMenus) || !empty($missingPromos) || !empty($missingGalleries)) {
    echo "  1. Copy missing image files from backup/source\n";
    echo "  2. Run this script again to verify\n";
    echo "  3. Clear browser cache (Ctrl+Shift+R)\n";
} else {
    echo "  1. Clear Laravel cache: php artisan cache:clear\n";
    echo "  2. Clear browser cache (Ctrl+Shift+R)\n";
    echo "  3. Reload the page\n";
}

echo "\n";
echo "[DONE]\n";
echo str_repeat("=", 60) . "\n";
