<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220928181459 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE alergenos (id INT AUTO_INCREMENT NOT NULL, alergeno VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categoria (id INT AUTO_INCREMENT NOT NULL, categoria VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE direccion (id INT AUTO_INCREMENT NOT NULL, cliente_id INT NOT NULL, municipio_id INT NOT NULL, provincia_id INT NOT NULL, calle VARCHAR(255) NOT NULL, numero VARCHAR(255) NOT NULL, puerta_piso_escalera VARCHAR(255) DEFAULT NULL, cod_postal INT NOT NULL, INDEX IDX_F384BE95DE734E51 (cliente_id), UNIQUE INDEX UNIQ_F384BE9558BC1BE0 (municipio_id), UNIQUE INDEX UNIQ_F384BE954E7121AF (provincia_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE estado (id INT AUTO_INCREMENT NOT NULL, estado VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE horario (id INT AUTO_INCREMENT NOT NULL, restaurante_id INT NOT NULL, dia INT NOT NULL, apertura TIME NOT NULL, cierre TIME NOT NULL, INDEX IDX_E25853A338B81E49 (restaurante_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pedido (id INT AUTO_INCREMENT NOT NULL, cliente_id INT NOT NULL, direccion_id INT NOT NULL, estado_id INT NOT NULL, restaurante_id INT NOT NULL, platos_id INT NOT NULL, total DOUBLE PRECISION NOT NULL, fecha_entrega DATETIME NOT NULL, INDEX IDX_C4EC16CEDE734E51 (cliente_id), UNIQUE INDEX UNIQ_C4EC16CED0A7BD7 (direccion_id), UNIQUE INDEX UNIQ_C4EC16CE9F5A440B (estado_id), INDEX IDX_C4EC16CE38B81E49 (restaurante_id), INDEX IDX_C4EC16CED77499C5 (platos_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE plato (id INT AUTO_INCREMENT NOT NULL, restaurante_id INT NOT NULL, nombre VARCHAR(255) NOT NULL, descripcion VARCHAR(255) DEFAULT NULL, img_url VARCHAR(255) DEFAULT NULL, precio DOUBLE PRECISION NOT NULL, INDEX IDX_914B3E4538B81E49 (restaurante_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE plato_alergenos (plato_id INT NOT NULL, alergenos_id INT NOT NULL, INDEX IDX_154F3317B0DB09EF (plato_id), INDEX IDX_154F3317B1C19196 (alergenos_id), PRIMARY KEY(plato_id, alergenos_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE restaurante (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(255) NOT NULL, logo_url VARCHAR(255) DEFAULT NULL, imagen_url VARCHAR(255) DEFAULT NULL, descripcion VARCHAR(255) DEFAULT NULL, destacado TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE restaurante_categoria (restaurante_id INT NOT NULL, categoria_id INT NOT NULL, INDEX IDX_6C73809938B81E49 (restaurante_id), INDEX IDX_6C7380993397707A (categoria_id), PRIMARY KEY(restaurante_id, categoria_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE direccion ADD CONSTRAINT FK_F384BE95DE734E51 FOREIGN KEY (cliente_id) REFERENCES cliente (id)');
        $this->addSql('ALTER TABLE direccion ADD CONSTRAINT FK_F384BE9558BC1BE0 FOREIGN KEY (municipio_id) REFERENCES municipios (id)');
        $this->addSql('ALTER TABLE direccion ADD CONSTRAINT FK_F384BE954E7121AF FOREIGN KEY (provincia_id) REFERENCES provincias (id)');
        $this->addSql('ALTER TABLE horario ADD CONSTRAINT FK_E25853A338B81E49 FOREIGN KEY (restaurante_id) REFERENCES restaurante (id)');
        $this->addSql('ALTER TABLE pedido ADD CONSTRAINT FK_C4EC16CEDE734E51 FOREIGN KEY (cliente_id) REFERENCES cliente (id)');
        $this->addSql('ALTER TABLE pedido ADD CONSTRAINT FK_C4EC16CED0A7BD7 FOREIGN KEY (direccion_id) REFERENCES direccion (id)');
        $this->addSql('ALTER TABLE pedido ADD CONSTRAINT FK_C4EC16CE9F5A440B FOREIGN KEY (estado_id) REFERENCES estado (id)');
        $this->addSql('ALTER TABLE pedido ADD CONSTRAINT FK_C4EC16CE38B81E49 FOREIGN KEY (restaurante_id) REFERENCES restaurante (id)');
        $this->addSql('ALTER TABLE pedido ADD CONSTRAINT FK_C4EC16CED77499C5 FOREIGN KEY (platos_id) REFERENCES plato (id)');
        $this->addSql('ALTER TABLE plato ADD CONSTRAINT FK_914B3E4538B81E49 FOREIGN KEY (restaurante_id) REFERENCES restaurante (id)');
        $this->addSql('ALTER TABLE plato_alergenos ADD CONSTRAINT FK_154F3317B0DB09EF FOREIGN KEY (plato_id) REFERENCES plato (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE plato_alergenos ADD CONSTRAINT FK_154F3317B1C19196 FOREIGN KEY (alergenos_id) REFERENCES alergenos (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE restaurante_categoria ADD CONSTRAINT FK_6C73809938B81E49 FOREIGN KEY (restaurante_id) REFERENCES restaurante (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE restaurante_categoria ADD CONSTRAINT FK_6C7380993397707A FOREIGN KEY (categoria_id) REFERENCES categoria (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE direccion DROP FOREIGN KEY FK_F384BE95DE734E51');
        $this->addSql('ALTER TABLE direccion DROP FOREIGN KEY FK_F384BE9558BC1BE0');
        $this->addSql('ALTER TABLE direccion DROP FOREIGN KEY FK_F384BE954E7121AF');
        $this->addSql('ALTER TABLE horario DROP FOREIGN KEY FK_E25853A338B81E49');
        $this->addSql('ALTER TABLE pedido DROP FOREIGN KEY FK_C4EC16CEDE734E51');
        $this->addSql('ALTER TABLE pedido DROP FOREIGN KEY FK_C4EC16CED0A7BD7');
        $this->addSql('ALTER TABLE pedido DROP FOREIGN KEY FK_C4EC16CE9F5A440B');
        $this->addSql('ALTER TABLE pedido DROP FOREIGN KEY FK_C4EC16CE38B81E49');
        $this->addSql('ALTER TABLE pedido DROP FOREIGN KEY FK_C4EC16CED77499C5');
        $this->addSql('ALTER TABLE plato DROP FOREIGN KEY FK_914B3E4538B81E49');
        $this->addSql('ALTER TABLE plato_alergenos DROP FOREIGN KEY FK_154F3317B0DB09EF');
        $this->addSql('ALTER TABLE plato_alergenos DROP FOREIGN KEY FK_154F3317B1C19196');
        $this->addSql('ALTER TABLE restaurante_categoria DROP FOREIGN KEY FK_6C73809938B81E49');
        $this->addSql('ALTER TABLE restaurante_categoria DROP FOREIGN KEY FK_6C7380993397707A');
        $this->addSql('DROP TABLE alergenos');
        $this->addSql('DROP TABLE categoria');
        $this->addSql('DROP TABLE direccion');
        $this->addSql('DROP TABLE estado');
        $this->addSql('DROP TABLE horario');
        $this->addSql('DROP TABLE pedido');
        $this->addSql('DROP TABLE plato');
        $this->addSql('DROP TABLE plato_alergenos');
        $this->addSql('DROP TABLE restaurante');
        $this->addSql('DROP TABLE restaurante_categoria');
    }
}
