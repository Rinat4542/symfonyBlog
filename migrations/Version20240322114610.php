<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240322114610 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE tags_to_blog (blog_id INT NOT NULL, tag_id INT NOT NULL, PRIMARY KEY(blog_id, tag_id))');
        $this->addSql('CREATE INDEX IDX_147AB9DDAE07E97 ON tags_to_blog (blog_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_147AB9DBAD26311 ON tags_to_blog (tag_id)');
        $this->addSql('ALTER TABLE tags_to_blog ADD CONSTRAINT FK_147AB9DDAE07E97 FOREIGN KEY (blog_id) REFERENCES blog (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE tags_to_blog ADD CONSTRAINT FK_147AB9DBAD26311 FOREIGN KEY (tag_id) REFERENCES tag (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE blog DROP blog_id');
        $this->addSql('ALTER INDEX idx_c015514312469de2dae07e97 RENAME TO IDX_C015514312469DE2');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE tags_to_blog DROP CONSTRAINT FK_147AB9DDAE07E97');
        $this->addSql('ALTER TABLE tags_to_blog DROP CONSTRAINT FK_147AB9DBAD26311');
        $this->addSql('DROP TABLE tags_to_blog');
        $this->addSql('ALTER TABLE blog ADD blog_id INT DEFAULT NULL');
        $this->addSql('ALTER INDEX idx_c015514312469de2 RENAME TO idx_c015514312469de2dae07e97');
    }
}
