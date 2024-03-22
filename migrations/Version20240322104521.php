<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240322104521 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE tag_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE tag (id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE blog DROP CONSTRAINT fk_c015514312469de2');
        $this->addSql('DROP INDEX idx_c015514312469de2');
        $this->addSql('ALTER TABLE blog ADD blog_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE blog ADD CONSTRAINT FK_C015514312469DE2DAE07E97 FOREIGN KEY (blog_id) REFERENCES category (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_C015514312469DE2DAE07E97 ON blog (blog_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE tag_id_seq CASCADE');
        $this->addSql('DROP TABLE tag');
        $this->addSql('ALTER TABLE blog DROP CONSTRAINT FK_C015514312469DE2DAE07E97');
        $this->addSql('DROP INDEX IDX_C015514312469DE2DAE07E97');
        $this->addSql('ALTER TABLE blog DROP blog_id');
        $this->addSql('ALTER TABLE blog ADD CONSTRAINT fk_c015514312469de2 FOREIGN KEY (category_id) REFERENCES category (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_c015514312469de2 ON blog (category_id)');
    }
}
