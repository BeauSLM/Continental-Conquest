from django.db import models

# Create your models here.
# This is an auto-generated Django model module.
# You'll have to do the following manually to clean this up:
#   * Rearrange models' order
#   * Make sure each model has one field with primary_key=True
#   * Make sure each ForeignKey and OneToOneField has `on_delete` set to the desired behavior
#   * Remove `managed = False` lines if you wish to allow Django to create, modify, and delete the table
# Feel free to rename the models, but don't rename db_table values or field names.
from django.db import models


class Ability(models.Model):
    name = models.CharField(db_column='Name', primary_key=True, max_length=30)  # Field name made lowercase.
    mana_cost = models.IntegerField(db_column='Mana_Cost')  # Field name made lowercase.
    description = models.CharField(db_column='Description', max_length=300)  # Field name made lowercase.
    damage = models.IntegerField(db_column='Damage', blank=True, null=True)  # Field name made lowercase.
    lv_req = models.IntegerField(db_column='Lv_Req')  # Field name made lowercase.
    cooldown = models.IntegerField(db_column='Cooldown')  # Field name made lowercase.

    class Meta:
        managed = False
        db_table = 'ability'


class Admins(models.Model):
    admin = models.OneToOneField('Users', models.DO_NOTHING, db_column='Admin_ID', primary_key=True)  # Field name made lowercase.
    perm_level = models.IntegerField(db_column='Perm_level')  # Field name made lowercase.

    class Meta:
        managed = False
        db_table = 'admins'


class CharBag(models.Model):
    acc = models.OneToOneField('Characters', models.DO_NOTHING, db_column='Acc_ID', primary_key=True)  # Field name made lowercase.
    char_name = models.ForeignKey('Characters', models.DO_NOTHING, db_column='Char_Name')  # Field name made lowercase.
    item = models.ForeignKey('Item', models.DO_NOTHING, db_column='Item_ID')  # Field name made lowercase.

    class Meta:
        managed = False
        db_table = 'char_bag'
        unique_together = (('acc', 'char_name', 'item'),)


class CharSlots(models.Model):
    acc = models.OneToOneField('Players', models.DO_NOTHING, db_column='Acc_ID', primary_key=True)  # Field name made lowercase.
    char_name = models.ForeignKey('Characters', models.DO_NOTHING, db_column='Char_Name')  # Field name made lowercase.
    item = models.ForeignKey('Item', models.DO_NOTHING, db_column='Item_ID', blank=True, null=True)  # Field name made lowercase.
    slot_type = models.CharField(db_column='Slot_Type', max_length=30)  # Field name made lowercase.

    class Meta:
        managed = False
        db_table = 'char_slots'
        unique_together = (('acc', 'char_name', 'slot_type'),)


class CharStats(models.Model):
    acc = models.OneToOneField('Characters', models.DO_NOTHING, db_column='Acc_ID', primary_key=True)  # Field name made lowercase.
    char_name = models.ForeignKey('Characters', models.DO_NOTHING, db_column='Char_Name')  # Field name made lowercase.
    atk = models.IntegerField(db_column='Atk')  # Field name made lowercase.
    def_field = models.IntegerField(db_column='Def')  # Field name made lowercase. Field renamed because it was a Python reserved word.
    hp = models.IntegerField(db_column='HP')  # Field name made lowercase.
    mp = models.IntegerField(db_column='MP')  # Field name made lowercase.
    spd = models.IntegerField(db_column='Spd')  # Field name made lowercase.

    class Meta:
        managed = False
        db_table = 'char_stats'
        unique_together = (('acc', 'char_name'),)


class Characters(models.Model):
    acct = models.OneToOneField('Players', models.DO_NOTHING, db_column='Acct_ID', primary_key=True)  # Field name made lowercase.
    name = models.CharField(db_column='Name', unique=True, max_length=20)  # Field name made lowercase.
    lvl = models.IntegerField(db_column='Lvl')  # Field name made lowercase.
    xp = models.IntegerField(db_column='XP')  # Field name made lowercase.
    gold = models.IntegerField(db_column='Gold')  # Field name made lowercase.
    location = models.CharField(db_column='Location', max_length=30)  # Field name made lowercase.
    race = models.ForeignKey('Race', models.DO_NOTHING, db_column='Race')  # Field name made lowercase.
    class_field = models.ForeignKey('Class', models.DO_NOTHING, db_column='Class')  # Field name made lowercase. Field renamed because it was a Python reserved word.
    party = models.ForeignKey('Party', models.DO_NOTHING, db_column='Party_ID', blank=True, null=True)  # Field name made lowercase.

    class Meta:
        managed = False
        db_table = 'characters'
        unique_together = (('acct', 'name'),)


class Class(models.Model):
    name = models.CharField(db_column='Name', primary_key=True, max_length=30)  # Field name made lowercase.
    description = models.CharField(db_column='Description', max_length=300)  # Field name made lowercase.

    class Meta:
        managed = False
        db_table = 'class'


class ClassAbility(models.Model):
    abil_name = models.OneToOneField(Ability, models.DO_NOTHING, db_column='Abil_name', primary_key=True)  # Field name made lowercase.
    class_field = models.ForeignKey(Class, models.DO_NOTHING, db_column='Class')  # Field name made lowercase. Field renamed because it was a Python reserved word.

    class Meta:
        managed = False
        db_table = 'class_ability'
        unique_together = (('abil_name', 'class_field'),)


class FriendList(models.Model):
    acct = models.OneToOneField('Players', models.DO_NOTHING, db_column='Acct_ID', primary_key=True)  # Field name made lowercase.
    friend = models.ForeignKey('Players', models.DO_NOTHING, db_column='Friend_ID')  # Field name made lowercase.

    class Meta:
        managed = False
        db_table = 'friend_list'
        unique_together = (('acct', 'friend'),)


class Guild(models.Model):
    guild_name = models.CharField(db_column='Guild_name', primary_key=True, max_length=30)  # Field name made lowercase.
    leader = models.ForeignKey('Players', models.DO_NOTHING, db_column='Leader_ID')  # Field name made lowercase.
    xp = models.IntegerField(db_column='XP')  # Field name made lowercase.
    level = models.IntegerField(db_column='Level')  # Field name made lowercase.
    gold = models.IntegerField(db_column='Gold')  # Field name made lowercase.

    class Meta:
        managed = False
        db_table = 'guild'


class Item(models.Model):
    item_id = models.AutoField(db_column='Item_ID', primary_key=True)  # Field name made lowercase.
    name = models.CharField(db_column='Name', max_length=50)  # Field name made lowercase.
    type = models.CharField(db_column='Type', max_length=30)  # Field name made lowercase.
    sell_price = models.IntegerField(db_column='Sell_price')  # Field name made lowercase.
    rarity = models.CharField(db_column='Rarity', max_length=30)  # Field name made lowercase.
    description = models.CharField(db_column='Description', max_length=100, blank=True, null=True)  # Field name made lowercase.
    item_category = models.CharField(db_column='Item_Category', max_length=30)  # Field name made lowercase.
    base_dmg = models.CharField(db_column='Base_Dmg', max_length=30, blank=True, null=True)  # Field name made lowercase.
    base_def = models.CharField(db_column='Base_Def', max_length=30, blank=True, null=True)  # Field name made lowercase.

    class Meta:
        managed = False
        db_table = 'item'


class ItemClassReq(models.Model):
    item = models.OneToOneField(Item, models.DO_NOTHING, db_column='Item_ID', primary_key=True)  # Field name made lowercase.
    class_field = models.ForeignKey(Class, models.DO_NOTHING, db_column='Class')  # Field name made lowercase. Field renamed because it was a Python reserved word.

    class Meta:
        managed = False
        db_table = 'item_class_req'
        unique_together = (('item', 'class_field'),)


class ItemStats(models.Model):
    item = models.OneToOneField(Item, models.DO_NOTHING, db_column='Item_ID', primary_key=True)  # Field name made lowercase.
    atk = models.IntegerField(db_column='Atk', blank=True, null=True)  # Field name made lowercase.
    def_field = models.IntegerField(db_column='Def', blank=True, null=True)  # Field name made lowercase. Field renamed because it was a Python reserved word.
    hp = models.IntegerField(db_column='HP', blank=True, null=True)  # Field name made lowercase.
    mp = models.IntegerField(db_column='MP', blank=True, null=True)  # Field name made lowercase.
    spd = models.IntegerField(db_column='Spd', blank=True, null=True)  # Field name made lowercase.

    class Meta:
        managed = False
        db_table = 'item_stats'


class Party(models.Model):
    party_id = models.IntegerField(db_column='Party_id', primary_key=True)  # Field name made lowercase.
    acct = models.ForeignKey('Players', models.DO_NOTHING, db_column='Acct_ID')  # Field name made lowercase.
    ch_name = models.ForeignKey(Characters, models.DO_NOTHING, db_column='Ch_name')  # Field name made lowercase.

    class Meta:
        managed = False
        db_table = 'party'
        unique_together = (('party_id', 'acct', 'ch_name'),)


class Players(models.Model):
    player = models.OneToOneField('Users', models.DO_NOTHING, db_column='Player_ID', primary_key=True)  # Field name made lowercase.
    playtime = models.CharField(db_column='Playtime', max_length=30)  # Field name made lowercase.
    sub_status = models.CharField(db_column='Sub_status', max_length=20)  # Field name made lowercase.
    guild = models.ForeignKey(Guild, models.DO_NOTHING, db_column='Guild', blank=True, null=True)  # Field name made lowercase.

    class Meta:
        managed = False
        db_table = 'players'


class Race(models.Model):
    name = models.CharField(db_column='Name', primary_key=True, max_length=30)  # Field name made lowercase.
    description = models.CharField(db_column='Description', max_length=300)  # Field name made lowercase.

    class Meta:
        managed = False
        db_table = 'race'


class RaceAbility(models.Model):
    abil_name = models.OneToOneField(Ability, models.DO_NOTHING, db_column='Abil_name', primary_key=True)  # Field name made lowercase.
    race = models.ForeignKey(Race, models.DO_NOTHING, db_column='Race')  # Field name made lowercase.

    class Meta:
        managed = False
        db_table = 'race_ability'
        unique_together = (('abil_name', 'race'),)


class Ticket(models.Model):
    ticket_id = models.AutoField(db_column='Ticket_ID', primary_key=True)  # Field name made lowercase.
    issue = models.CharField(db_column='Issue', max_length=500)  # Field name made lowercase.
    category = models.CharField(db_column='Category', max_length=30)  # Field name made lowercase.
    date = models.DateField(db_column='Date')  # Field name made lowercase.
    player = models.ForeignKey(Players, models.DO_NOTHING, db_column='Player_ID')  # Field name made lowercase.
    admin = models.ForeignKey(Admins, models.DO_NOTHING, db_column='Admin_ID', blank=True, null=True)  # Field name made lowercase.
    status = models.CharField(db_column='Status', max_length=15)  # Field name made lowercase.

    class Meta:
        managed = False
        db_table = 'ticket'


class Users(models.Model):
    acct_id = models.AutoField(db_column='Acct_ID', primary_key=True)  # Field name made lowercase.
    fname = models.CharField(db_column='Fname', max_length=20)  # Field name made lowercase.
    lname = models.CharField(db_column='Lname', max_length=20)  # Field name made lowercase.
    username = models.CharField(db_column='Username', max_length=20)  # Field name made lowercase.
    password = models.CharField(db_column='Password', max_length=16)  # Field name made lowercase.
    birthday = models.DateField(db_column='Birthday')  # Field name made lowercase.
    email = models.CharField(db_column='Email', max_length=40)  # Field name made lowercase.

    class Meta:
        managed = False
        db_table = 'users'
