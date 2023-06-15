<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230615121507 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE video_bookmarks (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE video_bookmarks_user (video_bookmarks_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_98D2F58D140CB0 (video_bookmarks_id), INDEX IDX_98D2F58A76ED395 (user_id), PRIMARY KEY(video_bookmarks_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE video_bookmarks_video (video_bookmarks_id INT NOT NULL, video_id INT NOT NULL, INDEX IDX_16F3E427D140CB0 (video_bookmarks_id), INDEX IDX_16F3E42729C1004E (video_id), PRIMARY KEY(video_bookmarks_id, video_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE video_bookmarks_user ADD CONSTRAINT FK_98D2F58D140CB0 FOREIGN KEY (video_bookmarks_id) REFERENCES video_bookmarks (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE video_bookmarks_user ADD CONSTRAINT FK_98D2F58A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE video_bookmarks_video ADD CONSTRAINT FK_16F3E427D140CB0 FOREIGN KEY (video_bookmarks_id) REFERENCES video_bookmarks (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE video_bookmarks_video ADD CONSTRAINT FK_16F3E42729C1004E FOREIGN KEY (video_id) REFERENCES video (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user CHANGE created_at created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE video_bookmarks_user DROP FOREIGN KEY FK_98D2F58D140CB0');
        $this->addSql('ALTER TABLE video_bookmarks_user DROP FOREIGN KEY FK_98D2F58A76ED395');
        $this->addSql('ALTER TABLE video_bookmarks_video DROP FOREIGN KEY FK_16F3E427D140CB0');
        $this->addSql('ALTER TABLE video_bookmarks_video DROP FOREIGN KEY FK_16F3E42729C1004E');
        $this->addSql('DROP TABLE video_bookmarks');
        $this->addSql('DROP TABLE video_bookmarks_user');
        $this->addSql('DROP TABLE video_bookmarks_video');
        $this->addSql('ALTER TABLE user CHANGE created_at created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
    }
}
