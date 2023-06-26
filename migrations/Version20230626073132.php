<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230626073132 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE video_tags DROP FOREIGN KEY FK_682BC9FA8D7B4FB4');
        $this->addSql('CREATE TABLE tag (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, file VARCHAR(255) DEFAULT NULL, updated_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('DROP TABLE tags');
        $this->addSql('DROP INDEX IDX_682BC9FA8D7B4FB4 ON video_tags');
        $this->addSql('DROP INDEX `primary` ON video_tags');
        $this->addSql('ALTER TABLE video_tags CHANGE tags_id tag_id INT NOT NULL');
        $this->addSql('ALTER TABLE video_tags ADD CONSTRAINT FK_682BC9FABAD26311 FOREIGN KEY (tag_id) REFERENCES tag (id) ON DELETE CASCADE');
        $this->addSql('CREATE INDEX IDX_682BC9FABAD26311 ON video_tags (tag_id)');
        $this->addSql('ALTER TABLE video_tags ADD PRIMARY KEY (video_id, tag_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE video_tags DROP FOREIGN KEY FK_682BC9FABAD26311');
        $this->addSql('CREATE TABLE tags (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, file VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, updated_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('DROP TABLE tag');
        $this->addSql('DROP INDEX IDX_682BC9FABAD26311 ON video_tags');
        $this->addSql('DROP INDEX `PRIMARY` ON video_tags');
        $this->addSql('ALTER TABLE video_tags CHANGE tag_id tags_id INT NOT NULL');
        $this->addSql('ALTER TABLE video_tags ADD CONSTRAINT FK_682BC9FA8D7B4FB4 FOREIGN KEY (tags_id) REFERENCES tags (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('CREATE INDEX IDX_682BC9FA8D7B4FB4 ON video_tags (tags_id)');
        $this->addSql('ALTER TABLE video_tags ADD PRIMARY KEY (video_id, tags_id)');
    }
}
