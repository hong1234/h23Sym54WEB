<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230827142116 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE location (id INT AUTO_INCREMENT NOT NULL, parentid INT DEFAULT NULL, name VARCHAR(255) NOT NULL, level INT NOT NULL, UNIQUE INDEX UNIQ_5E9E89CB856A684C (parentid), INDEX name (name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE location ADD CONSTRAINT FK_5E9E89CB856A684C FOREIGN KEY (parentid) REFERENCES location (id)');
        $this->addSql('DROP TABLE send_mail_templates');
        $this->addSql('ALTER TABLE user CHANGE roles roles JSON NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE send_mail_templates (mail_template_id INT AUTO_INCREMENT NOT NULL, kategorie_id BIGINT DEFAULT NULL, nachricht LONGTEXT CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, titel CHAR(63) CHARACTER SET utf8 DEFAULT \'NULL\' COLLATE `utf8_general_ci`, document_path VARCHAR(255) CHARACTER SET utf8 DEFAULT \'NULL\' COLLATE `utf8_general_ci`, insert_date DATETIME DEFAULT \'current_timestamp()\', PRIMARY KEY(mail_template_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_general_ci` ENGINE = MyISAM COMMENT = \'\' ');
        $this->addSql('ALTER TABLE location DROP FOREIGN KEY FK_5E9E89CB856A684C');
        $this->addSql('DROP TABLE location');
        $this->addSql('DROP TABLE messenger_messages');
        $this->addSql('ALTER TABLE user CHANGE roles roles LONGTEXT NOT NULL COLLATE `utf8mb4_bin`');
    }
}
