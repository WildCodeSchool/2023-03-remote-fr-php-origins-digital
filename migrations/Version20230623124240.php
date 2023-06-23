<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230623124240 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE video_tags (video_id INT NOT NULL, tags_id INT NOT NULL, INDEX IDX_682BC9FA29C1004E (video_id), INDEX IDX_682BC9FA8D7B4FB4 (tags_id), PRIMARY KEY(video_id, tags_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE video_tags ADD CONSTRAINT FK_682BC9FA29C1004E FOREIGN KEY (video_id) REFERENCES video (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE video_tags ADD CONSTRAINT FK_682BC9FA8D7B4FB4 FOREIGN KEY (tags_id) REFERENCES tags (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE video_tags DROP FOREIGN KEY FK_682BC9FA29C1004E');
        $this->addSql('ALTER TABLE video_tags DROP FOREIGN KEY FK_682BC9FA8D7B4FB4');
        $this->addSql('DROP TABLE video_tags');
    }
}
