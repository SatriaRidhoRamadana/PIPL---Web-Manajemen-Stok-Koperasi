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
            const dtLang = { search: "Cari:", lengthMenu: "Tampil _MENU_", info: "Menampilkan _START_ - _END_ dari _TOTAL_" };

            $('.datatable').each(function () {
                const $table = $(this);
                const colCount = $table.find('thead th').length;

                // base options
                const opts = {
                    pageLength: 10,
                    language: dtLang,
                    autoWidth: false,
                    responsive: true,
                };

                // apply sensible column widths depending on table shape
                if (colCount >= 6) {
                    // typical barang table: [kode, nama, kategori, harga, stok, aksi]
                    opts.columnDefs = [
                        { targets: 0, width: '90px', className: 'text-nowrap' },
                        { targets: 3, width: '120px', className: 'text-end' },
                        { targets: 4, width: '90px', className: 'text-end' },
                        { targets: 5, orderable: false, width: '140px', className: 'text-center' }
                    ];
                } else if (colCount === 2) {
                    // simple list with name + actions
                    opts.columnDefs = [
                        { targets: 0, width: '65%' },
                        { targets: 1, orderable: false, width: '35%', className: 'text-center' }
                    ];
                } else if (colCount === 3 || colCount === 4) {
                    // penjualan: [kode, waktu, total, ...]
                    opts.columnDefs = [
                        { targets: 0, width: '110px', className: 'text-nowrap' },
                        { targets: -1, orderable: false, width: '120px', className: 'text-center' }
                    ];
                }

                $table.DataTable(opts);
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

