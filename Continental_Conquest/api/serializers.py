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
