    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.8/js/dataTables.bootstrap5.min.js"></script>
    <script>
        function formatRupiah(value) {
            value = Number(value) || 0;
            return 'Rp ' + value.toLocaleString('id-ID');
        }

        $(function () {
            $('.datatable').DataTable({
                pageLength: 10,
                language: { search: "Cari:", lengthMenu: "Tampil _MENU_", info: "Menampilkan _START_ - _END_ dari _TOTAL_" }
            });
        });

        function addItemRow(button) {
            const selector = button.dataset.target;
            const table = document.querySelector(selector);
            if (!table) return;
            const newRow = table.querySelector('tbody tr').cloneNode(true);
            newRow.querySelectorAll('input').forEach(function (input) {
                input.value = '';
            });
            newRow.querySelectorAll('select').forEach(function (select) {
                select.selectedIndex = 0;
            });
            table.querySelector('tbody').appendChild(newRow);
        }

        function removeItemRow(button) {
            const row = button.closest('tr');
            const tbody = row.parentElement;
            if (tbody.querySelectorAll('tr').length > 1) {
                row.remove();
            } else {
                row.querySelectorAll('input').forEach(function (input) { input.value = ''; });
                row.querySelectorAll('select').forEach(function (select) { select.selectedIndex = 0; });
                row.querySelectorAll('.harga-text, .subtotal-text').forEach(function (el) { el.innerText = 'Rp 0'; });
            }
        }
    </script>
</body>
</html>

