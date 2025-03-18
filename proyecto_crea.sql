-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-03-2025 a las 02:52:45
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `proyecto_crea`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2019_08_19_000000_create_failed_jobs_table', 1),
(2, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(3, '2025_03_07_151101_create_users_table', 1),
(4, '2025_03_07_163418_create_personas_table', 2),
(5, '2025_03_07_193951_add_avatar_to_users_table', 3),
(6, '2025_03_13_135214_add_fecha_carnet_to_personas_table', 4),
(7, '2025_03_13_145929_add_carnet_identidad_to_personas_table', 5),
(8, '2025_03_18_014631_add_codigo_serviu_to_personas_table', 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personas`
--

CREATE TABLE `personas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `apellido` varchar(255) NOT NULL,
  `rut` varchar(255) NOT NULL,
  `codigo_serviu` varchar(255) DEFAULT NULL,
  `fecha_carnet` date DEFAULT NULL,
  `carnet_identidad` varchar(255) DEFAULT NULL,
  `carta_compromiso` varchar(255) DEFAULT NULL,
  `contrato_construccion` varchar(255) DEFAULT NULL,
  `post_subsidio` varchar(255) DEFAULT NULL,
  `te1` varchar(255) DEFAULT NULL,
  `tc6` varchar(255) DEFAULT NULL,
  `reduccion` varchar(255) DEFAULT NULL,
  `permiso` varchar(255) DEFAULT NULL,
  `recepcion_dom` varchar(255) DEFAULT NULL,
  `prohibicion_1` varchar(255) DEFAULT NULL,
  `prohibicion_2` varchar(255) DEFAULT NULL,
  `autoricese` varchar(255) DEFAULT NULL,
  `boleta_garantia_asistencia` varchar(255) DEFAULT NULL,
  `boleta_garantia_constructora` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `personas`
--

INSERT INTO `personas` (`id`, `nombre`, `apellido`, `rut`, `codigo_serviu`, `fecha_carnet`, `carnet_identidad`, `carta_compromiso`, `contrato_construccion`, `post_subsidio`, `te1`, `tc6`, `reduccion`, `permiso`, `recepcion_dom`, `prohibicion_1`, `prohibicion_2`, `autoricese`, `boleta_garantia_asistencia`, `boleta_garantia_constructora`, `created_at`, `updated_at`) VALUES
(2, 'Pablo', 'Monjes', '20514299-1', NULL, '2025-03-14', NULL, 'documentos/SdFAzklNASdbVtr8MxXEQhikYGByk98BL4xEFVht.jpg', 'documentos/Lsgt2ZCrurH8s6Ta0620uSJENvB72hTMD8saj7Pf.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-03-07 21:47:20', '2025-03-07 21:47:20'),
(3, 'Bruno', 'Figueroa', '20730760-2', NULL, NULL, NULL, 'documentos/O3yRzJvOUPU6QJYXrhw1mSinjuiOTy97ez3IZKi3.jpg', 'documentos/Tgg7nh3ObmHS2HIbhmNHI242TQCKRe1XW0jFFxnt.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-03-07 21:47:48', '2025-03-07 21:47:48'),
(4, 'Pablo', 'Gonzalez', '20520790-2', NULL, NULL, NULL, 'documentos/kRoRnEkuuDF46lUPvKDceBboYxmhtcxzl236D0eL.jpg', 'documentos/7Q4f3MatnQr2tDUeMk1NWSMfjjNqLCnMwNjP48ZN.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-03-07 21:48:57', '2025-03-07 21:48:57'),
(5, 'juanito', 'perez', '12345678-2', NULL, NULL, NULL, 'documentos/liBkDTs6C687pd47ooYCiM2IXmSR8A3DjYDDoPEi.pdf', 'documentos/Ca5SEcKbZF7vDP53CyinTPkETwgisxtasl24t99M.pdf', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-03-13 17:35:15', '2025-03-13 17:35:15'),
(6, 'juanita', 'perez', '20222000-2', NULL, '2025-03-15', NULL, 'documentos/3rBLliXmwASjnK2DitNvS3YGNbTUTp1x8Fb0a10h.pdf', 'documentos/ztYLQFtID95Y5a1caWhrWkijyqqZExatVEpOTHXN.pdf', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-03-13 17:42:27', '2025-03-13 17:42:27'),
(7, 'julius', 'oka', '20240440-2', NULL, '2025-03-22', 'documentos/Ze69xvVDjuhE8cLo1sVgA26u4x4uvVfYrlKyxFPo.pdf', 'documentos/zdrTe3CXflfckHDTSFIMeDgAqywS49gl1gapWchz.pdf', 'documentos/p28x9dwt1HGvuyI4aViTBJCOE2nt1LFirjEk0Y1B.pdf', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-03-13 18:12:30', '2025-03-18 00:29:55'),
(8, 'juan', 'alvarez', '20988922-3', NULL, '2025-03-27', 'documentos/leNntsMHwQQ6fTtPwSY1tMmFp0ipoxRMqps1WUVs.pdf', 'documentos/Y3YTVFWLoDo3qdxEgXGwAnxa389sJDASHDV7FSkY.pdf', 'documentos/OAuOCf0Rs8GT6uF6j9UxdnOSvduKBkzcN9NwG0ZM.pdf', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-03-13 18:16:55', '2025-03-13 18:16:55');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `last_name`, `email`, `avatar`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'User', 'admin@admin.com', NULL, '$2y$10$50qq2HcF6Vmvfc2RCk79wua814X4JLoyHjYX0cNxH8QSG6j7yI7ka', NULL, '2025-03-07 18:30:43', '2025-03-07 22:38:46');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indices de la tabla `personas`
--
ALTER TABLE `personas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personas_rut_unique` (`rut`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `personas`
--
ALTER TABLE `personas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
