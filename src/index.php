<?php

declare(strict_types=1);

require("/product-managament-v2/vendor/autoload.php");

use Oldemar\ProductManagamentV2\Controller\ProductController;

include_once('./views/top.php')
?>

<?php
// Load data
$productArr = (new ProductController())->allProduct();
?>

<div class="card">
    <div class="card-body">
        <h5 class="card-title">List of Products</h5>
        <!-- Controls -->
        <div class="btn-toolbar justify-content-between mb-2 mt-3" role="toolbar" aria-label="Toolbar with button groups">
            <div class="btn-group" role="group" aria-label="First group">
                <button type="button" class="btn btn-outline-secondary" disabled>Prev</button>
                <button type="button" class="btn btn-outline-dark">1</button>
                <button type="button" class="btn btn-outline-primary">Next</button>
            </div>
            <div class="input-group">
                <div class="input-group-text" id="searchBtnLabel">Search</div>
                <input type="text" onkeyup="filterFunction()" class="form-control" id="searchBtn" placeholder="Search here..." aria-label="Search here..." aria-describedby="searchBtnLabel">
            </div>
        </div>

        <!-- Table Contents -->
        <table class="table table-hover table-dark" id="productTable">
            <thead>
                <tr>
                    <th scope="col">#ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Price</th>
                    <th scope="col">Stock</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($productArr as $productObj => $data) {
                ?>
                    <!-- Dados -->
                    <tr>
                        <th scope="row"><?= $data->getID() ?></th>
                        <td><?= $data->getNAME() ?></td>
                        <td>€<?= $data->getPRICE() ?></td>
                        <td><?= $data->getSTOCK() ?></td>
                        <td>
                            <button type="button" class="btn btn-secondary">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                    <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z" />
                                </svg>
                            </button>
                            <button type="button" onclick="deleteFunction(<?= $data->getID() ?>)" class="btn btn-danger">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                                    <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                                </svg>
                            </button>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
        <div class="btn-toolbar justify-content-end mb-2 mt-3" role="toolbar" aria-label="Toolbar with button groups">
            <div class="btn-group" role="group" aria-label="First group" data-bs-toggle="modal" data-bs-target="#formModal">
                <button type="button" class="btn btn-primary">Add</button>
            </div>
        </div>

        <!-- Form Modal -->
        <div class="modal fade" id="formModal" tabindex="-1" aria-labelledby="formModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="formModalLabel">Add - Form</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <h5 class="text-center">Insert Product Informations</h5>
                        <hr>
                        <form id="createForm">
                            <div class="mb-3">
                                <label for="nameInput" class="form-label">Name</label>
                                <input type="text" class="form-control" id="nameInput" placeholder="Insert product name" required>
                            </div>
                            <div class="row g-3 justify-content-between">
                                <div class="col-auto">
                                    <label for="priceInput" class="form-label">Price €</label>
                                    <input type="number" class="form-control" id="priceInput" min="0.01" step="0.01" value="0" required>
                                </div>
                                <div class="col-auto">
                                    <label for="stock" class="form-label">Stock</label>
                                    <input type="number" class="form-control" id="stockInput" min="0" step="1" value="0" required>
                                </div>
                            </div>
                            <div class="modal-footer mt-3">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Create</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add new Product Script -->
    <script>
        form = document.getElementById("createForm");

        form.addEventListener('submit', function(e) {
            e.preventDefault();
            const name = document.getElementById("nameInput").value;
            const price = document.getElementById("priceInput").value;
            const stock = document.getElementById("stockInput").value;

            let errors = [];

            if (name == '' || name == null) {
                errors.push("name value is required");
            }

            if (price == '' || price == null) {
                errors.push("price value is required");
            }

            if (stock == '' || stock == null) {
                errors.push("stock value is required");
            }

            if (errors.length > 0) {
                alert(errors.toString());
                return;
            }

            const data = new URLSearchParams();
            const url = "http://localhost:3000/v1/project/create.php";

            data.append("name", name);
            data.append("price", price);
            data.append("stock", stock);

            fetch(url, {
                    method: 'post',
                    body: data,
                })
                .then(res => {
                    if (res.status == 201) {
                        alert("Product created successfully");
                        window.location.reload();
                    } else {
                        alert("Something goes wrong");
                        console.log(res);
                    }
                });
        })
    </script>

    <!-- Remove Product Script -->
    <script>
        function deleteFunction(id){
            const data = new URLSearchParams();
            const url = "http://localhost:3000/v1/project/delete.php";

            data.append("id", id);

            fetch(url, {
                    method: 'post',
                    body: data,
                })
                .then(res => {
                    if (res.status == 200) {
                        alert("Prodcut deleted successfully");
                        window.location.reload();
                    } else {
                        alert("Something goes wrong");
                        console.log(res);
                    }
                });
        }
    </script>

    <!-- Filter Products fron Table -->
    <script>
        function filterFunction() {
            var input, filter, table, tr, td, cell, i, j;
            filter = document.getElementById("searchBtn").value.toLowerCase();
            table = document.getElementById("productTable");
            tr = table.getElementsByTagName("tr");
            for (i = 1; i < tr.length; i++) {
                tr[i].style.display = "none";
                const tdArray = tr[i].getElementsByTagName("td");
                for (var j = 0; j < tdArray.length; j++) {
                    const cellValue = tdArray[j];
                    if (cellValue && cellValue.innerHTML.toLowerCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                        break;
                    }
                }
            }
        }
    </script>

    <?php
    include_once('./views/bottom.php')
    ?>