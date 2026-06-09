<?php
include_once('config/db.php');
$obj = new database();

// --- GET PARAMS ---
$search     = trim($_GET['q'] ?? '');
$cat_id     = intval($_GET['category'] ?? 0);
$min_price  = intval($_GET['min_price'] ?? 0);
$max_price  = intval($_GET['max_price'] ?? 0);
$sort       = $_GET['sort'] ?? 'default';

// --- FETCH ALL CATEGORIES (destinations) ---
$categories = $obj->select_data('destination');

// --- BUILD SEARCH QUERY ---
$db   = new database();
$conn = $db->connection;

$where_parts = [];

if (!empty($search)) {
    $s = $conn->real_escape_string($search);
    $where_parts[] = "(p.title LIKE '%$s%' OR p.location LIKE '%$s%' OR p.description LIKE '%$s%')";
}

if ($cat_id > 0) {
    /*
     * A package belongs to a category in two possible ways:
     *   1. Directly via p.destination_id  (domestic, international, amazing, etc.)
     *   2. Via subcategory: p.subcategory_id → subcategories.id → subcategories.category_id
     *      (India Tour packages id=8, Customize packages id=9)
     * We match either path so no package is ever missed.
     */
    $where_parts[] = "(p.destination_id = $cat_id
                       OR p.subcategory_id IN (
                           SELECT id FROM subcategories WHERE category_id = $cat_id
                       ))";
}

if ($min_price > 0) {
    $where_parts[] = "CAST(p.price AS UNSIGNED) >= $min_price";
}

if ($max_price > 0) {
    $where_parts[] = "CAST(p.price AS UNSIGNED) <= $max_price";
}

$where_sql = !empty($where_parts) ? 'WHERE ' . implode(' AND ', $where_parts) : '';

// Sort
$order_sql = match($sort) {
    'price_asc'  => 'ORDER BY CAST(p.price AS UNSIGNED) ASC',
    'price_desc' => 'ORDER BY CAST(p.price AS UNSIGNED) DESC',
    'name_asc'   => 'ORDER BY p.title ASC',
    default      => 'ORDER BY p.id DESC',
};

/*
 * JOIN explanation:
 *  - LEFT JOIN destination d  ON p.destination_id = d.id
 *      → gives category name for direct-linked packages
 *  - LEFT JOIN subcategories sc ON p.subcategory_id = sc.id
 *  - LEFT JOIN destination d2 ON sc.category_id    = d2.id
 *      → gives category name for subcategory-linked packages (India Tour / Customize)
 *  - COALESCE picks whichever is available
 */
$sql = "SELECT p.*,
               COALESCE(d.destination_name, d2.destination_name) AS destination_name
        FROM packages p
        LEFT JOIN destination d    ON p.destination_id  = d.id
        LEFT JOIN subcategories sc ON p.subcategory_id  = sc.id
        LEFT JOIN destination d2   ON sc.category_id    = d2.id
        $where_sql
        $order_sql";

$result   = $conn->query($sql);
$packages = $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
$total    = count($packages);

// Get price range for inputs
$price_result = $conn->query("SELECT MIN(CAST(price AS UNSIGNED)) as min_p,
                                     MAX(CAST(price AS UNSIGNED)) as max_p
                              FROM packages");
$price_range  = $price_result
    ? $price_result->fetch_assoc()
    : ['min_p' => 0, 'max_p' => 200000];

/*
 * Per-category counts must also reflect both linkage methods so sidebar
 * badge numbers are always accurate for India Tour & Customize too.
 */
function cat_package_count($conn, $cat_id) {
    $r = $conn->query("SELECT COUNT(*) AS c
                       FROM packages p
                       LEFT JOIN subcategories sc ON p.subcategory_id = sc.id
                       WHERE p.destination_id = $cat_id
                          OR sc.category_id   = $cat_id");
    return $r ? (int)$r->fetch_assoc()['c'] : 0;
}
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Search Packages – Welcome India</title>
  <meta name="description" content="Search travel packages across India and international destinations." />
  <?php include_once('includes/header-link.php'); ?>
  <style>
    /* ── Search bar ── */
    .search-hero {
      background: linear-gradient(135deg, #064168 0%, #0a6a72 100%);
      padding: 60px 20px 80px;
      text-align: center;
    }
    .search-hero h1 { color: #fff; font-size: clamp(1.6rem, 4vw, 2.8rem); margin-bottom: 8px; }
    .search-hero p  { color: rgba(255,255,255,.75); margin-bottom: 30px; font-size: 1rem; }

    .search-bar-wrap {
      max-width: 700px;
      margin: 0 auto;
      display: flex;
      background: #fff;
      border-radius: 50px;
      overflow: hidden;
      box-shadow: 0 8px 30px rgba(0,0,0,.25);
    }
    .search-bar-wrap input[type="text"] {
      flex: 1;
      border: none;
      outline: none;
      padding: 16px 24px;
      font-size: 1rem;
      color: #333;
    }
    .search-bar-wrap button {
      background: #f5a623;
      border: none;
      padding: 0 30px;
      font-size: 1.1rem;
      color: #fff;
      cursor: pointer;
      transition: background .2s;
    }
    .search-bar-wrap button:hover { background: #e09010; }

    /* ── Layout ── */
    .search-layout {
      max-width: 1280px;
      margin: -40px auto 60px;
      padding: 0 20px;
      display: grid;
      grid-template-columns: 280px 1fr;
      gap: 30px;
      align-items: start;
    }
    @media(max-width:900px){
      .search-layout { grid-template-columns: 1fr; margin-top: 20px; }
    }

    /* ── Sidebar ── */
    .filter-sidebar {
      background: #fff;
      border-radius: 20px;
      box-shadow: 0 4px 24px rgba(6,97,104,.10);
      padding: 28px 24px;
      position: sticky;
      top: 100px;
    }
    .filter-sidebar h3 {
      font-size: 1.1rem;
      font-weight: 700;
      color: #064168;
      margin-bottom: 18px;
      display: flex;
      align-items: center;
      gap: 8px;
    }
    .filter-sidebar h3 i { color: #f5a623; }

    .filter-group { margin-bottom: 28px; }
    .filter-group label.group-label {
      display: block;
      font-weight: 600;
      color: #333;
      margin-bottom: 10px;
      font-size: .92rem;
      text-transform: uppercase;
      letter-spacing: .04em;
    }

    /* Category pills */
    .cat-list { list-style: none; padding: 0; margin: 0; }
    .cat-list li { margin-bottom: 6px; }
    .cat-list li a {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 9px 14px;
      border-radius: 10px;
      color: #444;
      font-size: .93rem;
      text-decoration: none;
      border: 1.5px solid transparent;
      transition: all .2s;
    }
    .cat-list li a:hover,
    .cat-list li a.active {
      background: #e8f7f8;
      border-color: #0a6a72;
      color: #0a6a72;
      font-weight: 600;
    }
    .cat-list li a .badge {
      background: #f5a623;
      color: #fff;
      font-size: .72rem;
      font-weight: 700;
      padding: 2px 8px;
      border-radius: 20px;
    }
    .cat-list li a.active .badge { background: #0a6a72; }

    /* Price range */
    .price-inputs { display: flex; gap: 10px; }
    .price-inputs input {
      width: 50%;
      border: 1.5px solid #ddd;
      border-radius: 10px;
      padding: 8px 12px;
      font-size: .9rem;
      outline: none;
      color: #333;
    }
    .price-inputs input:focus { border-color: #0a6a72; }

    /* Sort select */
    .sort-select {
      width: 100%;
      border: 1.5px solid #ddd;
      border-radius: 10px;
      padding: 9px 12px;
      font-size: .93rem;
      color: #333;
      outline: none;
      background: #fff;
    }
    .sort-select:focus { border-color: #0a6a72; }

    .filter-apply-btn {
      width: 100%;
      background: #064168;
      color: #fff;
      border: none;
      border-radius: 12px;
      padding: 12px;
      font-size: 1rem;
      font-weight: 600;
      cursor: pointer;
      transition: background .2s;
      margin-top: 4px;
    }
    .filter-apply-btn:hover { background: #0a6a72; }

    .filter-reset {
      display: block;
      text-align: center;
      margin-top: 10px;
      color: #f5a623;
      font-size: .88rem;
      text-decoration: none;
      font-weight: 500;
    }
    .filter-reset:hover { text-decoration: underline; }

    /* ── Results area ── */
    .results-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 20px;
      flex-wrap: wrap;
      gap: 10px;
    }
    .results-header .result-count { font-size: 1rem; color: #555; }
    .results-header .result-count strong { color: #064168; }

    /* ── Package Cards ── */
    .pkg-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
      gap: 24px;
    }

    .pkg-card {
      background: #fff;
      border-radius: 20px;
      overflow: hidden;
      box-shadow: 0 4px 20px rgba(6,97,104,.10);
      transition: transform .25s, box-shadow .25s;
      display: flex;
      flex-direction: column;
    }
    .pkg-card:hover {
      transform: translateY(-6px);
      box-shadow: 0 12px 36px rgba(6,97,104,.18);
    }

    .pkg-card-img {
      position: relative;
      overflow: hidden;
      height: 210px;
    }
    .pkg-card-img img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      transition: transform .4s;
    }
    .pkg-card:hover .pkg-card-img img { transform: scale(1.06); }

    .pkg-cat-badge {
      position: absolute;
      top: 12px;
      left: 12px;
      background: rgba(6,65,104,.85);
      color: #fff;
      font-size: .75rem;
      font-weight: 600;
      padding: 4px 12px;
      border-radius: 20px;
      backdrop-filter: blur(4px);
    }

    .pkg-card-body {
      padding: 18px 20px 20px;
      flex: 1;
      display: flex;
      flex-direction: column;
    }
    .pkg-card-body h3 {
      font-size: 1.1rem;
      color: #064168;
      margin-bottom: 6px;
      font-weight: 700;
    }
    .pkg-location {
      font-size: .85rem;
      color: #888;
      margin-bottom: 10px;
      display: flex;
      align-items: center;
      gap: 5px;
    }
    .pkg-location i { color: #f5a623; }
    .pkg-desc {
      font-size: .88rem;
      color: #666;
      line-height: 1.55;
      flex: 1;
      margin-bottom: 14px;
    }
    .pkg-footer {
      display: flex;
      justify-content: space-between;
      align-items: center;
      border-top: 1px solid #f0f0f0;
      padding-top: 12px;
    }
    .pkg-price {
      font-size: 1.2rem;
      font-weight: 800;
      color: #f5a623;
    }
    .pkg-price span { font-size: .78rem; color: #999; font-weight: 400; }
    .pkg-btn {
      background: #064168;
      color: #fff;
      text-decoration: none;
      padding: 8px 18px;
      border-radius: 10px;
      font-size: .85rem;
      font-weight: 600;
      transition: background .2s;
    }
    .pkg-btn:hover { background: #0a6a72; color: #fff; }

    /* ── No results ── */
    .no-results {
      grid-column: 1 / -1;
      text-align: center;
      padding: 60px 20px;
    }
    .no-results i { font-size: 3.5rem; color: #ddd; display: block; margin-bottom: 16px; }
    .no-results h3 { color: #555; margin-bottom: 8px; }
    .no-results p  { color: #999; font-size: .95rem; }
    .no-results a  { color: #f5a623; font-weight: 600; }

    /* ── Highlight search term ── */
    mark { background: #fff3c4; color: #333; border-radius: 3px; padding: 0 2px; }
  </style>
</head>

<body id="bg" class="selection:bg-[#484848] selection:text-white">
  <?php include_once('includes/preloader.php'); ?>
  <?php include_once('includes/cursor.php'); ?>

  <div class="page-wraper">
    <?php include_once('includes/header.php'); ?>

    <div id="smooth-wrapper">
      <div id="smooth-content">
        <div class="page-content">

          <!-- ══ SEARCH HERO ══ -->
          <div class="search-hero">
            <h1>Find Your Perfect Tour</h1>
            <p>Explore hundreds of curated packages across India &amp; beyond</p>
            <form method="GET" action="search.php" id="heroSearchForm">
              <div class="search-bar-wrap">
                <input
                  type="text"
                  name="q"
                  id="heroSearchInput"
                  placeholder="Search destinations, packages, locations…"
                  value="<?php echo htmlspecialchars($search); ?>"
                  autocomplete="off" />
                <?php if ($cat_id > 0): ?>
                  <input type="hidden" name="category" value="<?php echo $cat_id; ?>" />
                <?php endif; ?>
                <?php if ($sort !== 'default'): ?>
                  <input type="hidden" name="sort" value="<?php echo htmlspecialchars($sort); ?>" />
                <?php endif; ?>
                <button type="submit"><i class="fa fa-search"></i></button>
              </div>
            </form>
          </div>
          <!-- ══ END HERO ══ -->

          <!-- ══ MAIN LAYOUT ══ -->
          <div class="search-layout">

            <!-- ─ SIDEBAR ─ -->
            <aside class="filter-sidebar">
              <h3><i class="fa fa-sliders-h"></i> Filter &amp; Sort</h3>

              <form method="GET" action="search.php" id="filterForm">
                <?php if (!empty($search)): ?>
                  <input type="hidden" name="q" value="<?php echo htmlspecialchars($search); ?>" />
                <?php endif; ?>

                <!-- Categories -->
                <div class="filter-group">
                  <label class="group-label">Category</label>
                  <ul class="cat-list">
                    <li>
                      <a href="search.php<?php echo !empty($search) ? '?q=' . urlencode($search) : ''; ?>"
                         class="<?php echo $cat_id === 0 ? 'active' : ''; ?>">
                        All Categories
                        <span class="badge"><?php
                          $total_all = $conn->query("SELECT COUNT(*) as c FROM packages")->fetch_assoc()['c'];
                          echo $total_all;
                        ?></span>
                      </a>
                    </li>
                    <?php foreach ($categories as $cat):
                      $cat_count = cat_package_count($conn, (int)$cat['id']);
                      $is_active = ($cat_id == $cat['id']);
                      $href_q    = !empty($search) ? '&q=' . urlencode($search) : '';
                    ?>
                      <li>
                        <a href="search.php?category=<?php echo $cat['id']; ?><?php echo $href_q; ?>"
                           class="<?php echo $is_active ? 'active' : ''; ?>">
                          <?php echo htmlspecialchars($cat['destination_name']); ?>
                          <span class="badge"><?php echo $cat_count; ?></span>
                        </a>
                      </li>
                    <?php endforeach; ?>
                  </ul>
                  <input type="hidden" name="category" id="cat_hidden" value="<?php echo $cat_id; ?>" />
                </div>

                <!-- Price Range -->
                <div class="filter-group">
                  <label class="group-label">Price Range (₹)</label>
                  <div class="price-inputs">
                    <input type="number" name="min_price" placeholder="Min"
                           value="<?php echo $min_price ?: ''; ?>"
                           min="0" max="<?php echo $price_range['max_p']; ?>" />
                    <input type="number" name="max_price" placeholder="Max"
                           value="<?php echo $max_price ?: ''; ?>"
                           min="0" max="<?php echo $price_range['max_p']; ?>" />
                  </div>
                  <div style="margin-top:8px; font-size:.8rem; color:#aaa;">
                    Range: ₹<?php echo number_format($price_range['min_p']); ?> – ₹<?php echo number_format($price_range['max_p']); ?>
                  </div>
                </div>

                <!-- Sort -->
                <div class="filter-group">
                  <label class="group-label">Sort By</label>
                  <select name="sort" class="sort-select">
                    <option value="default"    <?php echo $sort === 'default'    ? 'selected' : ''; ?>>Latest</option>
                    <option value="price_asc"  <?php echo $sort === 'price_asc'  ? 'selected' : ''; ?>>Price: Low → High</option>
                    <option value="price_desc" <?php echo $sort === 'price_desc' ? 'selected' : ''; ?>>Price: High → Low</option>
                    <option value="name_asc"   <?php echo $sort === 'name_asc'   ? 'selected' : ''; ?>>Name: A → Z</option>
                  </select>
                </div>

                <button type="submit" class="filter-apply-btn">
                  <i class="fa fa-check"></i> Apply Filters
                </button>
                <a href="search.php" class="filter-reset">✕ Reset all filters</a>
              </form>
            </aside>
            <!-- ─ END SIDEBAR ─ -->

            <!-- ─ RESULTS ─ -->
            <div style="margin-top: 50px;">
              <div class="results-header">
                <div class="result-count">
                  <?php if (!empty($search) || $cat_id > 0 || $min_price || $max_price): ?>
                    Showing <strong><?php echo $total; ?></strong> result<?php echo $total !== 1 ? 's' : ''; ?>
                    <?php if (!empty($search)): ?>
                      for <strong>"<?php echo htmlspecialchars($search); ?>"</strong>
                    <?php endif; ?>
                    <?php if ($cat_id > 0): ?>
                      <?php foreach ($categories as $c): if ($c['id'] == $cat_id): ?>
                        in <strong><?php echo htmlspecialchars($c['destination_name']); ?></strong>
                      <?php endif; endforeach; ?>
                    <?php endif; ?>
                  <?php else: ?>
                    Showing <strong>all <?php echo $total; ?></strong> packages
                  <?php endif; ?>
                </div>
              </div>

              <!-- Cards Grid -->
              <div class="pkg-grid">
                <?php if (!empty($packages)): ?>
                  <?php foreach ($packages as $pkg):
                    $img_src  = str_replace('../', '', htmlspecialchars($pkg['image']));
                    $title    = htmlspecialchars($pkg['title']);
                    $loc      = htmlspecialchars($pkg['location'] ?? '');
                    $price    = number_format((int)($pkg['price'] ?? 0));
                    $cat_name = htmlspecialchars($pkg['destination_name'] ?? '');
                    $desc     = mb_strimwidth(strip_tags($pkg['description'] ?? ''), 0, 110, '…');

                    // Highlight search term
                    if (!empty($search)) {
                      $esc_s = preg_quote(htmlspecialchars($search), '/');
                      $title = preg_replace("/($esc_s)/i", '<mark>$1</mark>', $title);
                      $loc   = preg_replace("/($esc_s)/i", '<mark>$1</mark>', $loc);
                      $desc  = preg_replace("/($esc_s)/i", '<mark>$1</mark>', strip_tags($desc));
                    }
                  ?>
                    <div class="pkg-card">
                      <div class="pkg-card-img">
                        <a href="package-detail.php?id=<?php echo $pkg['id']; ?>">
                          <img src="<?php echo $img_src; ?>"
                               alt="<?php echo htmlspecialchars($pkg['title']); ?>"
                               loading="lazy"
                               onerror="this.src='assets/images/background/inr-banner.jpg'" />
                        </a>
                        <?php if ($cat_name): ?>
                          <span class="pkg-cat-badge"><?php echo $cat_name; ?></span>
                        <?php endif; ?>
                      </div>
                      <div class="pkg-card-body">
                        <h3><?php echo $title; ?></h3>
                        <?php if ($loc): ?>
                        <div class="pkg-location">
                          <i class="fa fa-map-marker-alt"></i>
                          <?php echo $loc; ?>
                        </div>
                        <?php endif; ?>
                        <p class="pkg-desc"><?php echo $desc; ?></p>
                        <div class="pkg-footer">
                          <div class="pkg-price">
                            ₹<?php echo $price; ?><span>/- per person</span>
                          </div>
                          <a href="package-detail.php?id=<?php echo $pkg['id']; ?>" class="pkg-btn">
                            View Details
                          </a>
                        </div>
                      </div>
                    </div>
                  <?php endforeach; ?>

                <?php else: ?>
                  <div class="no-results">
                    <i class="fa fa-search"></i>
                    <h3>No packages found</h3>
                    <p>Try a different keyword or <a href="search.php">browse all packages</a>.</p>
                  </div>
                <?php endif; ?>
              </div>
            </div>
            <!-- ─ END RESULTS ─ -->

          </div>
          <!-- ══ END LAYOUT ══ -->

        </div><!-- page-content -->

        <?php include_once('includes/footer.php'); ?>
      </div>
    </div>

    <button class="scroltop">
      <span class="fa fa-angle-up relative" id="btn-vibrate"></span>
    </button>
    <?php include_once('includes/off-canvas.php'); ?>
  </div>

  <?php include_once('includes/footer-link.php'); ?>

  <script>
    document.getElementById('heroSearchInput').addEventListener('keydown', function(e) {
      if (e.key === 'Enter') {
        e.preventDefault();
        document.getElementById('heroSearchForm').submit();
      }
    });
  </script>
</body>
</html>
