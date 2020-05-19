ALTER TABLE `fichas` ADD `id_sindicato` INT NOT NULL AFTER `id_cliente`;
ALTER TABLE `fichas` ADD `es_casa_central` INT NOT NULL DEFAULT '0' AFTER `saldo_adicional`;
ALTER TABLE `fichas` ADD `nro_cliente` TEXT NOT NULL AFTER `beneficiario`;
ALTER TABLE `clientes` CHANGE `nombre_cliente` `titular_cliente` VARCHAR(60) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL;
ALTER TABLE `clientes` CHANGE `apellido_cliente` `beneficiario_cliente` VARCHAR(60) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL;
ALTER TABLE `stock` ADD `cantidad_minima` INT NOT NULL AFTER `cantidad`;
