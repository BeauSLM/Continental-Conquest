from django.db.models import fields
from rest_framework import serializers
from api.models import *

class AbilitySerializer(serializers.ModelSerializer):
    class Meta:
        model = Ability
        fields = (
            'name',
            'mana_cost',
            'description',
            'damage',
            'lv_req',
            'cooldown'
        )

class AdminSerializer(serializers.ModelSerializer):
    class Meta:
        model = Admins
        fields = (
            'admin',
            'perm_level'
        )

class CharbagSerializer(serializers.ModelSerializer):
    class Meta:
        model = CharBag
        fields = (
            'acc',
            'char_name',
            'item'
        )

class CharslotSerializer(serializers.ModelSerializer):
    class Meta:
        model = CharSlots
        fields = (
            'acc',
            'char_name',
            'item',
            'slot_type'
        )

class CharstatsSerializer(serializers.ModelSerializer):
    class Meta:
        model = CharStats
        fields = (
            'acc',
            'char_name',
            'atk',
            'def_field',
            'hp',
            'mp',
            'spd'
        )

class CharactersSerializer(serializers.ModelSerializer):
    class Meta:
        model = Characters
        fields = (
            'acct',
            'name',
            'lvl',
            'xp',
            'gold',
            'location',
            'race',
            'class_field',
            'party'
        )

class ClassSerializer(serializers.ModelSerializer):
    class Meta:
        model = Class 
        fields = (
            'name',
            'description',
        )

class ClassabilitySerializer(serializers.ModelSerializer):
    class Meta:
        model = ClassAbility
        fields = (
            'abil_name',
            'class_field'
        )

class FriendListSerializer(serializers.ModelSerializer):
    class Meta:
        model = FriendList
        fields = (
            'acct',
            'friend'
        )

class GuildSerializer(serializers.ModelSerializer):
    class Meta:
        model = Guild
        fields = (
            'guild_name',
            'leader',
            'xp',
            'level',
            'gold'
        )

class ItemSerializer(serializers.ModelSerializer):
    class Meta:
        model = Item
        fields = (
            'item_id',
            'name',
            'type',
            'sell_price',
            'rarity',
            'description',
            'item_category',
            'base_dmg',
            'base_def'
        )

class ItemclassreqSerializer(serializers.ModelSerializer):
    class Meta: 
        model = ItemClassReq
        fields = (
            'item',
            'class_field'
        )

class ItemstatSerializer(serializers.ModelSerializer):
    class Meta:
        model = ItemStats
        fields = (
            'item',
            'atk',
            'def_field',
            'hp',
            'mp',
            'spd',
        )

class PartySerializer(serializers.ModelSerializer):
    class Meta:
        model = Party
        fields = (
            'party_id',
            'acct',
            'ch_name'
        )

class PlayersSerializer(serializers.ModelSerializer):
    class Meta:
        model = Players
        fields = (
            'player',
            'playtime',
            'sub_status',
            'guild'
        )

class RaceSerializer(serializers.ModelSerializer):
    class Meta:
        model = Race
        fields = (
            'name',
            'description'
        )

class RaceabilitySerializer(serializers.ModelSerializer):
    class Meta:
        model = RaceAbility
        fields = (
            'abil_name',
            'race'
        )

class TicketSerializer(serializers.ModelSerializer):
    class Meta:
        model = Ticket
        fields = (
            'ticket_id',
            'issue',
            'category',
            'date',
            'player',
            'admin',
            'status'
        )

class UserSerializer(serializers.ModelSerializer):
    class Meta:
        model = Users
        fields = (
            'acct_id',
            'fname',
            'lname',
            'username',
            'password',
            'birthday',
            'email'
        )

