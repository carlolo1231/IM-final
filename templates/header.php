<?php

error_reporting(E_ALL & ~E_WARNING & ~E_NOTICE);
ini_set('display_errors', '0');

require 'vendor/autoload.php';

use Aries\MiniFrameworkStore\Models\Category;

$categories = new Category();

session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Ababan Store</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="assets/css/styles.css" />
    <style>
        /* Navbar background */
        .navbar.bg-dark {
            background-color: #1a73e8 !important;
        }

        /* Navbar brand and nav links */
        .navbar .navbar-brand,
        .navbar .nav-link,
        .navbar .nav-link.active,
        .navbar .nav-link.dropdown-toggle {
            color: white !important;
        }

        /* Navbar links hover */
        .navbar .nav-link:hover,
        .navbar .nav-link.active:hover,
        .navbar .nav-link.dropdown-toggle:hover {
            color: #dbe9ff !important;
        }

        /* Dropdown menu background */
        .dropdown-menu.animate-dropdown {
            background-color: #e3f0ff;
        }

        /* Dropdown items */
        .dropdown-menu.animate-dropdown .dropdown-item {
            color: #1a73e8;
        }

        /* Dropdown item hover */
        .dropdown-menu.animate-dropdown .dropdown-item:hover {
            background-color: #a1c4fd;
            color: white;
        }

        /* Cart badge */
        .badge.bg-danger {
            background-color: #dc3545 !important;
        }

        /* Body background and text */
        body.store-body {
            background-color: #f5f9ff;
            color: #222;
        }
    </style>
</head>
<body class="store-body">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm fade-in-section">
        <div class="container">
            <a class="navbar-brand fw-bold fs-4 logo-animate" href="index.php">Ababan Online Store</a>
            <button
                class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent"
                aria-expanded="false"
                aria-label="Toggle navigation"
            >
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active px-3" aria-current="page" href="index.php">Homepage</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link px-3" href="add-product.php">Register Product</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a
                            class="nav-link dropdown-toggle px-3"
                            href="#"
                            role="button"
                            data-bs-toggle="dropdown"
                            aria-expanded="false"
                        >
                            Categories
                        </a>
                        <ul class="dropdown-menu animate-dropdown">
                            <?php foreach ($categories->getAll() as $category): ?>
                                <li>
                                    <a class="dropdown-item" href="category.php?name=<?= htmlspecialchars($category['name']) ?>">
                                        <?= htmlspecialchars($category['name']) ?>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </li>
                </ul>
                <a class="icon-link position-relative me-3" href="cart.php" title="Cart">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="#ffffff"
                        version="1.1"
                        id="Capa_1"
                        width="24px"
                        height="24px"
                        viewBox="0 0 902.86 902.86"
                        xml:space="preserve"
                    >
                        <g>
                            <g>
                                <path
                                    d="M671.504,577.829l110.485-432.609H902.86v-68H729.174L703.128,179.2L0,178.697l74.753,399.129h596.751V577.829z
                                    M685.766,247.188l-67.077,262.64H131.199L81.928,246.756L685.766,247.188z"
                                />
                                <path
                                    d="M578.418,825.641c59.961,0,108.743-48.783,108.743-108.744s-48.782-108.742-108.743-108.742H168.717
                                    c-59.961,0-108.744,48.781-108.744,108.742s48.782,108.744,108.744,108.744c59.962,0,108.743-48.783,108.743-108.744
                                    c0-14.4-2.821-28.152-7.927-40.742h208.069c-5.107,12.59-7.928,26.342-7.928,40.742
                                    C469.675,776.858,518.457,825.641,578.418,825.641z M209.46,716.897c0,22.467-18.277,40.744-40.743,40.744
                                    c-22.466,0-40.744-18.277-40.744-40.744c0-22.465,18.277-40.742,40.744-40.742
                                    C191.183,676.155,209.46,694.432,209.46,716.897z M619.162,716.897c0,22.467-18.277,40.744-40.743,40.744
                                    s-40.743-18.277-40.743-40.744c0-22.465,18.277-40.742,40.743-40.742S619.162,694.432,619.162,716.897z"
                                />
                            </g>
                        </g>
                    </svg>
                    <span id="cart-count" class="badge bg-danger position-absolute top-0 start-100 translate-middle">
                        <?= countCart() ?>
                    </span>
                </a>
                <ul class="navbar-nav mb-2 mb-lg-0">
                    <li class="nav-item dropdown">
                        <a
                            class="nav-link dropdown-toggle px-3"
                            href="#"
                            role="button"
                            data-bs-toggle="dropdown"
                            aria-expanded="false"
                        >
                            Hello, <?= isset($_SESSION['user']) ? htmlspecialchars($_SESSION['user']['name']) : 'Guest' ?>
                        </a>
                        <ul class="dropdown-menu animate-dropdown">
                            <?php if (isLoggedIn()): ?>
                                <li><a class="dropdown-item" href="my-account.php">Account Info</a></li>
                                <?php if (isset($_SESSION['user']) && $_SESSION['user']['role_id'] == 1): ?>
                                    <li><a class="dropdown-item" href="dashboard.php">Dashboard</a></li>
                                <?php endif; ?>
                                <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                            <?php else: ?>
                                <li><a class="dropdown-item" href="login.php">Login</a></li>
                                <li><a class="dropdown-item" href="register.php">Register</a></li>
                            <?php endif; ?>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>