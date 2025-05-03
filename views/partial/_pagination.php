<?php
// views/client/_pagination.php
// This partial view contains just the pagination controls - updated for AJAX POST functionality
?>

<?php if ($pagination['totalPages'] > 1): ?>
  <nav aria-label="Page navigation">
    <ul class="pagination justify-content-center">
      <?php if ($pagination['hasPrevPage']): ?>
        <li class="page-item">
          <a class="page-link pagination-link" href="#" data-page="<?php echo $pagination['currentPage'] - 1; ?>" aria-label="Previous">
            <span aria-hidden="true">&laquo;</span>
          </a>
        </li>
      <?php else: ?>
        <li class="page-item disabled">
          <span class="page-link" aria-hidden="true">&laquo;</span>
        </li>
      <?php endif; ?>
      
      <?php
      // Determine range of page numbers to show
      $startPage = max(1, $pagination['currentPage'] - 2);
      $endPage = min($pagination['totalPages'], $pagination['currentPage'] + 2);
      
      // Always show first page
      if ($startPage > 1): ?>
        <li class="page-item">
          <a class="page-link pagination-link" href="#" data-page="1">1</a>
        </li>
        <?php if ($startPage > 2): ?>
          <li class="page-item disabled">
            <span class="page-link">...</span>
          </li>
        <?php endif; ?>
      <?php endif; ?>
      
      <?php for ($i = $startPage; $i <= $endPage; $i++): ?>
        <li class="page-item <?php echo $i === $pagination['currentPage'] ? 'active' : ''; ?>">
          <a class="page-link pagination-link" href="#" data-page="<?php echo $i; ?>"><?php echo $i; ?></a>
        </li>
      <?php endfor; ?>
      
      <?php 
      // Always show last page
      if ($endPage < $pagination['totalPages']): ?>
        <?php if ($endPage < $pagination['totalPages'] - 1): ?>
          <li class="page-item disabled">
            <span class="page-link">...</span>
          </li>
        <?php endif; ?>
        <li class="page-item">
          <a class="page-link pagination-link" href="#" data-page="<?php echo $pagination['totalPages']; ?>"><?php echo $pagination['totalPages']; ?></a>
        </li>
      <?php endif; ?>
      
      <?php if ($pagination['hasNextPage']): ?>
        <li class="page-item">
          <a class="page-link pagination-link" href="#" data-page="<?php echo $pagination['currentPage'] + 1; ?>" aria-label="Next">
            <span aria-hidden="true">&raquo;</span>
          </a>
        </li>
      <?php else: ?>
        <li class="page-item disabled">
          <span class="page-link" aria-hidden="true">&raquo;</span>
        </li>
      <?php endif; ?>
    </ul>
  </nav>
<?php endif; ?>