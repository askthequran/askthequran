import os
import openai
import discord
from discord.ext import commands

# Load your API keys from environment variables
OPENAI_API_KEY = os.environ.get("OPENAI_API_KEY")
DISCORD_BOT_TOKEN = os.environ.get("DISCORD_BOT_TOKEN")

# Set up OpenAI API
openai.api_key = OPENAI_API_KEY

# Set up Discord bot
bot = commands.Bot(command_prefix="!")

@bot.event
async def on_ready():
    print(f"We have logged in as {bot.user}")

@bot.command()
async def ask(ctx, *, question):
    # Call the ChatGPT API with the user's question
    response = openai.Completion.create(
        engine="text-davinci-002",
        prompt=f"{question}\n",
        max_tokens=100,
        n=1,
        stop=None,
        temperature=0.7,
    )

    # Send the response to the Discord chat
    answer = response.choices[0].text.strip()
    await ctx.send(answer)

bot.run(DISCORD_BOT_TOKEN)
